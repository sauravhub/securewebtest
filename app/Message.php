<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'reciever_id', 'is_seen', 'is_attachment'];

    public function user()
	{
	  return $this->belongsTo(User::class);
	}
	
	public function sender()
	{
	  return $this->belongsTo(User::class, 'reciever_id');
	}
	
    public function getCreateAtAttribute($value)
	{
	    return Carbon::parse($value)->diffForHumans();
	}
	
	public static function messagesCount(){
        return Message::where('user_id', Auth::user()->id)->where('is_seen', 1)->count();
    }
	protected $table = 'messages';
}
