<template>
	<div class="view_chat">
		<div class="inner_view">
			<h4>{{ ( messages.recieverInfo )? messages.recieverInfo.name : 'No chat selected' }}</h4>
			<input type="hidden" name="reciever" v-model="reciever" />
			<div class="message-container">
				<div class="fullwidth vertical_align mb" :class="{'right_chat': (user.id == message.user.id),  
					'left_chat': (user.id != message.user.id) }"   v-for="message in messages.messages">
					<div class="pro_img col-md-2"> 
						<div class="img_container" :style="{ 'background': ( user.id == message.user.id )? 'url(uploads/' + user.profile_pic + ')' : 'url(uploads/' + message.user.profile_pic + ')'  }" ></div>
					</div>
					<div class="chat_msg col-md-7 chat_message vertical_align">
						<p v-if="message.is_attachment == 1"><a :href="message.fileurl" _blank download>{{ message.message }} <i class="fa fa-file" style="font-size: 30px;margin-left: 10px"></i></a></p>
						<p v-else>{{ message.message }}</p>
					</div>
					<div class="chat_timing col-md-3">
						<span>{{ message.newdate}}</span>			
					</div> 
				</div>
			</div>
			<div class="fullwidth vertical_align mtop70 sendmsgcontainer">
				<div class="type_message vertical_align">
					<div class="col-md-10">
						<textarea @keyup.enter="sendMessage" v-model="newMessage" name="message" placeholder="Type your message.."></textarea>
					</div>
					<div class="col-md-2 vertical_align">
						<!--<img src="backend/images/attachment.png" alt="">-->
						<file-upload :url='url' :thumb-url='thumbUrl' :accept="accept" :additional-data="additionalData" :headers="headers" @change="mySaveMethod"></file-upload>
						<button :disabled="newMessage.length < 1" class="send"><img src="backend/images/paper_palne.png" id="btn-chat" @click="sendMessage" alt=""></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
  export default {
        props: ['messages', 'user', 'filepath'],

        data() {
            return {
                newMessage: '',
                recieverInfo: {
                	name: '',
                	id: 0,
                },
                reciever:'',
                url: window.Laravel.url + '/chat/attachments',
                accept: '.png,.jpg,.docx,.pdf,.doc,.txt',
    			headers: { 'access-token': window.Laravel.csrfToken },
    			additionalData: {
    				'_token': window.Laravel.csrfToken,
    				reciever: 0
    			},
            }
        },
        updated(){
        	this.additionalData.reciever = this.messages.recieverInfo.id;
        },
        methods: {
            sendMessage() {
                if( this.newMessage.trim() ){
                    this.$emit('messagesent', {
                        user: this.user,
                        message: this.newMessage
                    });
                    this.newMessage = '';
                }
            },
            thumbUrl (file) {
		      return file.myThumbUrlProperty
		    },
            mySaveMethod(reponse) {
		      this.$emit('fetchusers', this.additionalData.reciever);
		    }
        }    
    }
</script>