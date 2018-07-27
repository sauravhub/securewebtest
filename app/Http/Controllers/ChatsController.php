<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use App\User;
use App\Like;
use App\Match;
use App\Trials;
use App\Features;
use App\FeatureUses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use App\WordsSecurity;
use Mail;
class ChatsController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * Show chats
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('chat');
	}

	/**
	 * Fetch all messages
	 *
	 * @return Message
	 */
	public function fetchMessages( $reciever )
	{
		$messageInfo = array();
		$messages = Message::where( [ 'reciever_id' => $reciever, 'user_id' => Auth::user()->id ] )
				->orWhereRaw( ' ( reciever_id = ' . Auth::user()->id .' AND  user_id = ' . $reciever .' )' )
				->with('user')
				->get();
		if( count( $messages ) ){
			Message::where('reciever_id', '=', Auth::user()->id)->update(['is_seen' => 0]);
			$messages->transform(function ($item, $key) {
				if( $item->created_at ){
					$date2 = Carbon::parse($item->created_at);
					$item->newdate =  $date2->diffForHumans();
					$item->fileurl = '';
					if( $item->is_attachment == 1 ){
						$item->fileurl = url('/uploads/messages'). '/' . $item->message;
					}

					return $item;
				}
			});
		} 
		$messageInfo['messages'] = $messages;
		$messageInfo['recieverInfo'] = User::find($reciever);
		return json_encode($messageInfo);
	}
	
	public function fetchusers()
	{

		return User::where('id', '!=',  Auth::user()->id )->get();
	}
	
	public function fetchchattingusers()
	{
		$userinfo = $validation  = array();
		$query = '';

		$messages =	DB::select('select * from `messages` WHERE id IN (
				    SELECT MAX(id)
				    FROM messages
				    where  ( reciever_id = ' . Auth::user()->id .' OR  user_id = ' . Auth::user()->id .' )
				    '.$query.'
				    GROUP BY reciever_id
				) order by id DESC');
		if( $messages ){
			$i = 0;
			foreach( $messages as $message ){
				$user_id = $message->reciever_id;
				if( Auth::user()->id == $message->reciever_id ){
					$user_id = $message->user_id;
				}
				if ( !in_array($user_id, $validation ) ) {
					$userdata = User::find($user_id);
					if( $userdata ){
						$date = Carbon::now();
						$date2 = Carbon::parse($message->created_at);
						$message->newdate =  $date->diffForHumans($date2, true, true, 1);
						$message->message = str_limit( $message->message, 20 );
						$validation[] = $user_id;
						$userinfo[$i]['message'] = $message;
						$userinfo[$i]['user'] = $userdata;		
						$userinfo[$i]['seen'] = $ttlcount = Message::where(['is_seen' => 1, 'user_id' => $user_id, 'reciever_id' => Auth::user()->id ])->count();		
						$i++;
					}
				}
			}
		}
		return json_encode( $userinfo );
	}
	

	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessage(Request $request)
	{

		$messageInfo = $request->input('message');
		$reciever_id = $request->input('reciever');
		if( $messageInfo['message'] ){
			$user = Auth::user();
			$isnewuser = Message::where( [ 'reciever_id' => $reciever_id, 'user_id' => Auth::user()->id ] )
				->orWhereRaw( ' ( reciever_id = ' . Auth::user()->id .' AND  user_id = ' . $reciever_id .' )' )
				->count();
			$messageContent = $messageInfo['message'];


			$message = $user->messages()->create([
				'is_seen' => 1,
				'reciever_id' => $request->input('reciever'),
				'message' => $messageContent,
			]);
			$date = Carbon::now();
			$date2 = Carbon::parse($message->created_at);
			$message->newdate =  $date->diffForHumans($date2, true, true, 1);

			
			broadcast(new MessageSent($user, $message))->toOthers();
			
			
			return ['status' => 'Message Sent!'];
		}
	}
	
	public function getCurrntuserdata(){
		$reciever_id = 0;
		$query = '';

		$message =	DB::select('select * from `messages` WHERE id IN (
				    SELECT MAX(id)
				    FROM messages
				    where  ( reciever_id = ' . Auth::user()->id .' OR  user_id = ' . Auth::user()->id .' )
				    '.$query.'
				    GROUP BY reciever_id
				) order by id DESC limit 0, 1');
		if( count( $message ) ){
			$reciever_id = $message[0]->reciever_id;
			if( Auth::user()->id == $message[0]->reciever_id ){
				$reciever_id = $message[0]->user_id;
			}
		}
		return ['rid' => $reciever_id, 'cid' => Auth::user()->id];
	}
	
	public function messageAttachments( Request $request ){
		$reciever_id = $request->input('reciever');
		if( $reciever_id ){
			$extention = $request->file->getClientOriginalExtension();
			$imageName = $request->file->getClientOriginalName();
			$newfilename = md5( date('h:i:s').$imageName ).'.'.$extention;
			$request->file->move( public_path() . '/uploads/messages/', $newfilename );
			if( $newfilename ){
				$user = Auth::user();
				$message = $user->messages()->create([
					'is_seen' => 1,
					'reciever_id' => $request->input('reciever'),
					'message' => $newfilename,
					'is_attachment' => 1,
				]);
				$date = Carbon::now();
				$date2 = Carbon::parse($message->created_at);
				$message->newdate =  $date->diffForHumans($date2, true, true, 1);
				broadcast(new MessageSent($user, $message))->toOthers();
				return ['status' => 'Message Sent!'];
			}
		}
		return ['status' => 'Message Not Sent!'];
		
	}
	public function testfunction(){
		

	}
	

}
