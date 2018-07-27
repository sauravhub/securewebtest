@extends('layouts.chat')
@section('htmlheader')
     <script src="{{ asset('js/app.js') }}" defer></script>
	 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('main-content')
<div class="maincontent">
	<div class="content bgwhite">
        <div class="chat">
        	<div class="container-fluid">
        		<h4 class="font22 inline_block"><b class="vertical_align">CHAT</b></h4>
        			<hr>
        	
        		   	<div class="mtop30">
            		    <chat-users v-on:fetchusers="fetchMessages" :chatnewusers="chatnewusers" :chatusers="chatusers"></chat-users>
            			<chat-messages v-on:messagesent="addMessage" v-on:fetchusers="fetchMessages" :user="{{ Auth::user() }}" :messages="messages"></chat-messages>
            		</div>

        	</div>	
        </div>
    </div>
    <div class="chat_notify" id="notifyerror"><i class="fa fa-warning"></i> <span>Notification</span></div>
</div>
@endsection