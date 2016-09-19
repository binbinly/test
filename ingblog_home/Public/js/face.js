 $(document).ready(function(e) {
        ImgIputHandler.Init();
    });
var ImgIputHandler={
        facePath:[
            {faceName:"微笑",facePath:"0_微笑.gif"},
            {faceName:"撇嘴",facePath:"1_撇嘴.gif"},
            {faceName:"色",facePath:"2_色.gif"},
            {faceName:"发呆",facePath:"3_发呆.gif"},
            {faceName:"得意",facePath:"4_得意.gif"},
            {faceName:"流泪",facePath:"5_流泪.gif"},
            {faceName:"害羞",facePath:"6_害羞.gif"},
            {faceName:"闭嘴",facePath:"7_闭嘴.gif"},
            {faceName:"大哭",facePath:"9_大哭.gif"},
            {faceName:"尴尬",facePath:"10_尴尬.gif"},
            {faceName:"发怒",facePath:"11_发怒.gif"},
            {faceName:"调皮",facePath:"12_调皮.gif"},
            {faceName:"龇牙",facePath:"13_龇牙.gif"},
            {faceName:"惊讶",facePath:"14_惊讶.gif"},
            {faceName:"难过",facePath:"15_难过.gif"},
            {faceName:"酷",facePath:"16_酷.gif"},
            {faceName:"冷汗",facePath:"17_冷汗.gif"},
            {faceName:"抓狂",facePath:"18_抓狂.gif"},
            {faceName:"吐",facePath:"19_吐.gif"},
            {faceName:"偷笑",facePath:"20_偷笑.gif"},
            {faceName:"可爱",facePath:"21_可爱.gif"},
            {faceName:"白眼",facePath:"22_白眼.gif"},
            {faceName:"傲慢",facePath:"23_傲慢.gif"},
            {faceName:"饥饿",facePath:"24_饥饿.gif"},
            {faceName:"困",facePath:"25_困.gif"},
            {faceName:"惊恐",facePath:"26_惊恐.gif"},
            {faceName:"流汗",facePath:"27_流汗.gif"},
            {faceName:"憨笑",facePath:"28_憨笑.gif"},
            {faceName:"大兵",facePath:"29_大兵.gif"},
            {faceName:"奋斗",facePath:"30_奋斗.gif"},
            {faceName:"咒骂",facePath:"31_咒骂.gif"},
            {faceName:"疑问",facePath:"32_疑问.gif"},
            {faceName:"嘘",facePath:"33_嘘.gif"},
            {faceName:"晕",facePath:"34_晕.gif"},
            {faceName:"折磨",facePath:"35_折磨.gif"},
            {faceName:"衰",facePath:"36_衰.gif"},
            {faceName:"骷髅",facePath:"37_骷髅.gif"},
            {faceName:"敲打",facePath:"38_敲打.gif"},
            {faceName:"再见",facePath:"39_再见.gif"},
            {faceName:"擦汗",facePath:"40_擦汗.gif"},
            {faceName:"抠鼻",facePath:"41_抠鼻.gif"},
            {faceName:"鼓掌",facePath:"42_鼓掌.gif"},
            {faceName:"糗大了",facePath:"43_糗大了.gif"},
            {faceName:"坏笑",facePath:"44_坏笑.gif"},
            {faceName:"左哼哼",facePath:"45_左哼哼.gif"},
            {faceName:"右哼哼",facePath:"46_右哼哼.gif"},
            {faceName:"哈欠",facePath:"47_哈欠.gif"},
            {faceName:"鄙视",facePath:"48_鄙视.gif"},
            {faceName:"委屈",facePath:"49_委屈.gif"},
            {faceName:"快哭了",facePath:"50_快哭了.gif"},
            {faceName:"阴险",facePath:"51_阴险.gif"},
            {faceName:"亲亲",facePath:"52_亲亲.gif"},
            {faceName:"吓",facePath:"53_吓.gif"},
            {faceName:"可怜",facePath:"54_可怜.gif"},
            {faceName:"菜刀",facePath:"55_菜刀.gif"},
            {faceName:"西瓜",facePath:"56_西瓜.gif"},
            {faceName:"啤酒",facePath:"57_啤酒.gif"},
            {faceName:"篮球",facePath:"58_篮球.gif"},
            //{faceName:"乒乓",facePath:"59_乒乓.gif"},
            {faceName:"拥抱",facePath:"78_拥抱.gif"},
            {faceName:"握手",facePath:"81_握手.gif"},
        ]
        ,
        Init:function(){
            var isShowImg=false;
            $(".faceBtn").click(function(){
                if(isShowImg==false){
                    isShowImg=true;
                    $(".faceDiv").show();
                    $(".faceDiv").animate({marginTop:"-160px"},300);
                    if($(".faceDiv").children().length==0){
                        for(var i=0;i<ImgIputHandler.facePath.length;i++){
                            $(".faceDiv").append("<img title=\""+ImgIputHandler.facePath[i].faceName+"\" src='"+image_base_url+"/face/"+ImgIputHandler.facePath[i].facePath+"' />");
                        }
                        $(".faceDiv>img").click(function(){
                            isShowImg=false;
                            $(".faceDiv").hide();
                            $('.faceDiv').animate({marginTop:"0px"},300);
                            ImgIputHandler.insertAtCursor($(".comment_text")[0],"["+$(this).attr("title")+"]");
                        });
                    }
                }else{
                    isShowImg=false;
                    $(".faceDiv").hide();
                    $(this).parent().prev().animate({marginTop:"0px"},300);
                }
            });
        },
        insertAtCursor:function(myField, myValue) {
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
                sel.select();
            } else if (myField.selectionStart || myField.selectionStart == "0") {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                var restoreTop = myField.scrollTop;
                myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
                if (restoreTop > 0) {
                    myField.scrollTop = restoreTop;
                }
                myField.focus();
                myField.selectionStart = startPos + myValue.length;
                myField.selectionEnd = startPos + myValue.length;
            } else {
                myField.value += myValue;
                myField.focus();
            }
        }
    }
 $(function(){
     $(".imageBtn").click(function(){
         alert("开发中...");
     });
     //头像处理
     initAvatar(6);
     $(".user_avatar").click(function(){
         $(".user_avatar").css('border', '');
         $(this).css('border', '1px solid #66AFE9');
         $("input[name=avatar]").val($(this).attr("name"));
     });
     $(".comment_reply").on('click', function(){
         reply_tourist_id = $(this).attr('data-uid');
         reply_comment_id = $(this).attr("data-id");
         comment_type = 2;
         $("#comment_text").val('回复 '+$(this).parent().find('.media-heading').html() + ': ');

         //滚动条移动
         var hei = $('#commentForm').position().top;
         var scrollTop = document.body.scrollTop;
         $('html, body').animate({scrollTop:hei});
     });
     $('.refresh_avatar').click(function(){
         $(".avatarDir").html("");
         initAvatar(6);
     });
     //验证
     $("#commentForm").validate({
         submitHandler: function(form) {
             var comment_text = $("#comment_text").val();
             if(!uid) {
                 username = $("#username").val();
                 var email = $("#email").val();
                 avatar = $("input[name=avatar]").val();
             }
             var data = {
                 username:username,
                 email:email,
                 comment_text:comment_text,
                 avatar:avatar,
                 post_id:post_id,
                 reply_tourist_id:reply_tourist_id,
                 reply_comment_id:reply_comment_id,
                 type:comment_type
             };
             $.post(add_comment_url, data, function(data){
                 if(data.code == 1) {
                     layer.msg(data.msg);
                     if(!uid) {
                         $("#commentForm .has-remove").remove();
                         var url = image_base_url + '/avatar/' + avatar + '.jpg';
                         var html = '<div class="col-sm-2"> ' +
                             '<img src="' + url + '" class="user_avatar"> ' +
                             '<p class="text-center user_name">' + username + '</p></div>';
                         $("#commentForm .has-avatar").find('.control-label').remove();
                         $("#commentForm .has-avatar").prepend(html);
                         uid = data.data.uid;
                     }
                     $("#comment_text").val("");
                     var commentHtml = '<div class="row comment-row"> ' +
                         '<div class="col-sm-2 comment_avatar"> ' +
                         '<img src="'+image_base_url+'/avatar/'+avatar+'.jpg" class="user_avatar"></div> ' +
                         '<div class="col-sm-9"> ' +
                         '<div class="media-heading h4">'+username+'</div> ' +
                         '<p class="comment_text">'+comment_text+'</p> ' +
                         '<a href="javascrip:;" class="comment_act comment_reply" data-id="'+data.data.comment_id+'" data-uid="'+uid+'">回复</a> </div> ' +
                         '<div class="col-sm-1 comment_story"> ' +
                         '<p class="text-right">顶 楼</p> ' +
                         '<p class="text-right">刚刚</p> </div> </div>';
                     $(".commentList").prepend(commentHtml);
                 }else{
                     layer.msg(data.msg);
                 }
             }, 'json');
         },
         rules: {
             'username': {
                 required: true,
                 minlength: 2
             },
             'email': {
                 required: true,
                 email: true
             },
             'comment_text': {
                 required: true,
                 minlength: 3
             }
         },
         messages: {
             'username': {
                 required: "请输入昵称",
                 minlength: "昵称必须1个字符以上哦!"
             },
             'email': {
                 required: "请输入邮箱",
                 email: "邮箱格式不对哦，亲!"
             },
             'comment_text': {
                 required: "内容不能为空哦",
                 minlength: "内容必须3个字符以上哦!"
             }
         }
     });
 });

 function initAvatar(count) {
     var randomArr = randomNumber(count);
     for(var i = 0;i<randomArr.length; i++) {
         var url = image_base_url + '/avatar/'+randomArr[i]+'.jpg';
         $(".avatarDir").eq(0).append('<img class="user_avatar" src="'+url+'" name="'+randomArr[i]+'">');
     }
 }

 //随机获取5个1-100的数字
 function randomNumber(count){
     var array = [];
     var length = 0;
     while(length < count) {
         var random = parseInt(Math.random()*100)+1;
         var flag = 0;
         for(var i=0; i<length; i++) {
            if(array[i] == random) {
                flag = 1;
                break;
            }
         }
         if(flag == 0) {
             array.push(random);
             length++;
         }
     }
     return array;
 }