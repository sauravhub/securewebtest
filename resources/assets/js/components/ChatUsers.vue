<template>
    <div class="chat_list">
		<h3>Chat</h3>
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">NEW</button>
		<ul>
			<li class="vertical_align" @click="getMessages(chatuser.user.id)" v-for="chatuser in chatusers">
				<div class="pro_img col-md-3 padding17">
					<div class="img_container" :style="{ 'background': 'url(https://wf.vanillicon.com/f27de43a5e56df38231862498a6737a5_100.png)'  }" ></div>
					<span v-if="chatuser.seen">{{ chatuser.seen }}</span>
				</div>
				<div class="pro_name col-md-6 ">
					<h6>{{ chatuser.user.name }}</h6>
					<span>{{ chatuser.message.message }}</span>
				</div>
				<div class="pro_status col-md-3 padding17">
					<div v-if="chatuser.user.is_online > 0" class="online_status"></div>
					<span>{{ chatuser.message.newdate }}</span>
				</div>
			</li>
		</ul>
		<div id="myModal" class="modal fade" role="dialog">
		    <div class="modal-dialog">
		        <!-- Modal content-->
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal">&times;</button>
		            </div>
		            <div class="modal-body">
		                <div class="matchtabs newchatuserslist pt30">
		                    <div class="container-fluid">
		                        <div class="col-md-12 mtopbottom20">
		                            <div class="col-md-3 mb text-center" data-dismiss="modal" @click="getMessages(newuser.id)" v-for="newuser in chatnewusers">
		                                <div class="img_container" :style="{ 'background': 'url(https://wf.vanillicon.com/f27de43a5e56df38231862498a6737a5_100.png)'  }" ></div>
		                                <div v-if="newuser.is_online" class="online_status"></div>
		                                <div class="mtopbottom10">
		                                    <h5>{{ newuser.name }}</h5>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</template>

<script>
  export default {
    props: ['chatusers', 'chatnewusers'],
    
    data() {
        return {
            reciever_id: 0,
        }
    },

    methods: {
        getMessages(reciever_id) {
            this.$emit('fetchusers', reciever_id);
        }
    }
    
  };
</script>