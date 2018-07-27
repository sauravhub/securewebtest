<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin');
    }


      public function store()
    {

      $post= new Contact ;
      $post->username = request('username');
      $post->companyname = request('password');
      $post->email = request('address');
      $post->contactno = request('age');
      $post->save();


      $contacts = Contact::all();
      return view('store',compact('contacts'));
    
    }
}