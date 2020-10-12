<template>
<div class="panel panel-default">
  <div class="panel-body">
   <div class="row chat-widget-row" id="chat-widget-row">

    <div class="col-md-3 contact-sidebar">
        <div class="panel-heading clearfix">
            <h4 class="mt-5 mb-5">Contacts</h4>
        </div>
            <div class="card card-default">
                <!-- <div class="card-header">Chats</div> -->
                <div class="card-body">
                    <ul class="contacts list-unstyled" v-if="contacts.length > 0">
                        <li  v-for="(contacts, index) in contacts" :key="index" 
                            @click="loadMessages(contacts.id, contacts.name);" :data-contact="contacts.id"
                        :class="(contacts.id == reciever) ? 'py-2 text-capitalize active' : 'py-2 text-capitalize' ">
                            {{ contacts.name }}
                            <span v-html="contacts.unseen"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

       <div class="col-md-9 right-box">
        <div class="panel-heading clearfix">
            <h4 class="mt-5 mb-5 text-center relative">
                {{ recievername == null ? 'Messages' : recievername }}
                <span v-if="scrsize < 768" class="ti-arrow-left back-key" @click="backBtn();"></span>
                <span v-if="reciever != null && messages.length > 0"  
                    class="ti-trash del-chat-icon" 
                    @click="deleteChat(reciever);">
                </span>
               </h4>
           </div>
           <div class="card card-default">
               <div class="chat-body p-0">
                   <div class="intro-chat text-center row align-items-center justify-content-center" 
                   style="min-height: 300px;"  v-if="reciever == null">
                       <div>
                           <h2>Hi {{ loginUser.name }}!</h2>  
                            <div class="no-contacts" v-if="contacts.length == 0">
                                No Conversation found.
                            </div>  
                            <div class="new-message-alert">
                                
                            </div>
                       </div>
                   </div>
                    <div class="chat-box" v-if="reciever != null">

                       <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>

                           <li :class="(loginUser.id === message.user.id)? 'p-2 sent-message' : 'p-2 recieved-message' "  v-for="(message, index) in messages" :key="index" >
                                <div class="inner">
                                    <div class="message-info">
                                        <strong v-if="message.user.id !== loginUser.id">{{ message.user.name }}</strong>
                                        <span class="created-at">{{ message.created_at }}</span>
                                        <span class="status" v-if="loginUser.id === message.user.id">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15" width="16" height="15">
                                                <path :fill="message.status == 1 ? '#0f75bc' : ''" d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path>
                                            </svg>

                                        </span>
                                    </div>
                                    <div class="message">
                                        <span v-html="message.message"></span>
                                    </div>
                                </div>
                           </li>

                       </ul>
                       <div class="send-form">
                            <textarea
                                @keydown="sendTypingEvent"
                                @keyup.enter="sendMessage"
                                v-model="newMessage"
                                type="text"
                                name="message"
                                placeholder="Enter your message..."
                                class="form-control"></textarea>
                                <span  class="sendmsgicon" @click="sendMessage">
                                    <i class="ti-location-arrow"></i>
                                </span>
                        </div>
                    </div>
                </div>
           </div>
            <!-- <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} is typing...</span> -->
       </div>

       
        <!-- <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->

   </div>
  </div>
</div>
</template>

<script>
    export default {
        props:['user'],
        data() {
        var scrsize = screen.width;  
        var s = 0;  
        var n = sessionStorage.getItem('recievername');  
        if(scrsize > 1024){
            s = sessionStorage.getItem('reciever');  
        }
            return {
                messages: [],
                contacts: [],
                contactsIds: [],
                newMessage: '',
                reciever: s > 0 ? s : null,
                recievername: n != undefined ? n : null,
                loginUser: this.user,
                typer: 0,
                scrsize: scrsize,
                users:[],
                activeUser: false,
                typingTimer: false,
            }
        },
        created() {
            this.fetchContacts(); 
            if(this.reciever != null){
                this.loadMessages(this.reciever, this.recievername); 
            }
            Echo.join('chat')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                })
                // .listen('ChatEvent',(event) => {
                //     this.messages.push(event.chat);
                // })
                // .listenForWhisper('typing', user => {
                //    this.activeUser = user;
                //     if(this.typingTimer) {
                //         clearTimeout(this.typingTimer);
                //     }
                //    this.typingTimer = setTimeout(() => {
                //        this.activeUser = false;
                //    }, 1000);
                // });

                Echo.private('chat.'+this.user.id)
                  .listen('ChatEvent',(event)=>{

                    if(event.chat.user_id == this.reciever){
                        this.messages.push(event.chat);
                        axios.get('read/'+event.chat.id);
                        return;
                    } else if(this.contactsIds.includes(event.chat.user_id)) {
                      
                    } else{
                        // console.log(this.contacts);
                        this.contacts.push( {id: event.chat.user_id , name: event.chat.user.name} );
                        this.contactsIds.push(event.chat.user_id );
                    }
                    var unseen = $('.contacts').find('[data-contact="'+event.chat.user_id+'"] span');
                    var count = unseen.html();
                    if(count == ''){
                        unseen.html(1);
                    } else{
                        count = parseInt(count);
                        unseen.html(++count);
                    }
                    $('.contacts').find('[data-contact="'+event.chat.user_id+'"]').prependTo('.contacts');
                });
        },
        methods: {
            // fetchMessages() {
            //     axios.get('messages').then(response => {
            //         this.messages = response.data;
            //     })
            // },
            deleteChat(id) {
                var s = confirm("Are you sure you want to delete this chat?");
                if(s){
                    axios.get('delete/'+id).then(response => {
                        this.messages = [];
                    });
                }
            },
            localTime(){
                var date = new Date();
                var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
                var am_pm = date.getHours() >= 12 ? "pm" : "am";
                hours = hours < 10 ? "0" + hours : hours;
                var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                var time = hours + ":" + minutes + " " + am_pm;
                return time;
            },
            loadMessages(id, name = this.recievername) {
                sessionStorage.setItem("reciever", id);
                sessionStorage.setItem("recievername", name);
                this.reciever = id;
                this.recievername = name;
                $('#chat-widget-row').addClass('message-screen-up');
                this.messages = [];
                axios.get('messages/'+id).then(response => {
                    this.messages = response.data;
                    $('[data-contact="'+id+'"] span').html('');
                });  
            },
            fetchContacts() {
                axios.get('contacts').then(response => {
                    var contacts = response.data.contacts;
                    var unseen = response.data.unseen;
                    for (var i = 0; i < contacts.length; i++) {
                        this.contactsIds.push(contacts[i].id);                        
                        for (var j = 0; j < unseen.length; j++) {
                            if(contacts[i].id == unseen[j].user_id){
                                contacts[i].unseen = unseen[j].total;
                            }
                        } 
                    } 
                    this.contacts = contacts; 

                    // if(response.data.length > 0 && this.reciever == null && this.scrsize > 1024){
                    //     this.reciever = response.data[0].id;
                    //     this.loadMessages(this.reciever);
                    // }
                });
            },
            sendMessage(e) {
                var shifted = e.shiftKey;
                if(shifted) return;
                var msg = this.newMessage;
                if(this.newMessage.trim().length > 0){
                    this.newMessage = '';
                    // var msg = this.newMessage.replace(/\r\n|\r|\n/g,"<br>");
                    this.messages.push({
                        user: this.user,
                        reciever: this.reciever,
                        created_at: this.localTime(),
                        status: 0,
                        message: msg
                    });
                    axios.post('messages', {message: msg, reciever: this.reciever});
                    $('.contacts').find('[data-contact="'+this.reciever+'"]').prependTo('.contacts');
                   // setTimeout(() => { 
                   //      this.loadMessages(this.reciever);
                   //  }, 1000);
                }
            },
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
                    
            },

            backBtn(){
                $('#chat-widget-row').removeClass('message-screen-up');
                this.reciever = null;
            }
        }
    }
</script> 