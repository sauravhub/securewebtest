
	
	  // for tab selection //
    	$("div.profile-tab-menu>div.list-group>a").click(function(e) {
             e.preventDefault();
             $(this).siblings('a.active').removeClass("active");
             $(this).addClass("active");
             var index = $(this).index();
             $("div.profile-tab>div.profile-tab-content").removeClass("active");
             $("div.profile-tab>div.profile-tab-content").eq(index).addClass("active");
      });
    
    // for drag drop images // 
     Dropzone.options.imageUpload = {
            maxFilesize  : 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
        
      // for reset the model //  
       $('#myModal').on('hidden.bs.modal', function () {
           location.reload();
           
      
});

function getGoup(user_group_id) { 
     $.ajax({
       url: window.Laravel.url + '/frontend/getGroup/' + user_group_id ,
       type: 'POST',
       data: {'_token': $('input[name=_token]').val()},
       dataType: 'JSON',
       success: function (data) {
          var htmldata = '';
           if( data.status ){
              for (var i = 0; i < data.genderInfo.length; i++) {
                 htmldata += ' <input type="radio" name="gender" value="'+ data.genderInfo[i].id +'"> '+ data.genderInfo[i].title;
              }
              jQuery('#genderInfodisplay').html(htmldata);
           }
       }
   });
}

$("div.profile-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.profile-tab>div.profile-tab-content").removeClass("active");
        $("div.profile-tab>div.profile-tab-content").eq(index).addClass("active");
    });


