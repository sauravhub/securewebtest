
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import FileUpload from 'v-file-upload';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(FileUpload);

import { FileUploadService } from 'v-file-upload';
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-users', require('./components/ChatUsers.vue'));

const app = new Vue({
    el: '#app',

    data: {
        reciever: 0,
        messages: [],
        chatusers: [],
        chatnewusers: [],
        currentUserId: 0,
    },
    mounted(){
        this.fetchcurrentuserId();
        this.newusers();
    },
    methods: {
        fetchMessages( reciever ) {
            const vm = this;
            vm.reciever = reciever;
            axios.get('/chat/messages/' + reciever ).then(response => {
                vm.messages = response.data;
                vm.fetchUsers();
                vm.scrollToEnd();
            });
        },
        scrollToEnd: function() {    	
          var container = this.$el.querySelector(".message-container");
          var sendmsgcontainer = this.$el.querySelector(".sendmsgcontainer");
          container.scrollTop = container.scrollHeight;
          $(".message-container").animate({ scrollTop: $(document).height() * 20 }, 1000);
        },
        addMessage(message) {
            const vm = this;
            vm.reciever = vm.messages.recieverInfo.id;
            var reciever = vm.reciever;
            axios.post('/chat/messages', {message, reciever} ).then(response => {
                if( response.data.status = 'Error'){
                    document.getElementById('notifyerror').innerHTML = response.data.erroMsg;
                    $('#notifyerror').show().delay(3000).fadeOut();
                }
                vm.fetchMessages( vm.reciever );
                vm.fetchUsers();
            });
        }, 
        fetchUsers(){
            axios.get('/chat/chattedusers' ).then(response => {
                this.chatusers = response.data;
            });
        },
        newusers(){
            axios.get('/chat/users' ).then(response => {
                this.chatnewusers = response.data;
            });
        },
        fetchcurrentuserId(){
            const vm = this;
            axios.get('/chat/currentUserId' ).then(response => {
                vm.reciever = response.data.rid;
                vm.fetchMessages( vm.reciever );
                vm.currentUserId = response.data.cid;
                    Echo.private('App.User.' + vm.currentUserId)
                    .listen('MessageSent', (e) => {
                        vm.fetchMessages( e.message.user_id );
                        vm.fetchUsers();
                    });  

            });
        }
    }
});


