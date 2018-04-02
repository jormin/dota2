$(function(){
    // $('.am-dropdown').on('mouseover',function(){
    //     $(this).addClass('am-active');
    // });
    // $('.am-dropdown').on('mouseout',function(){
    //     $(this).removeClass('am-active');
    // });
//     if($('.get').width() < 640){
//     $('.get').height($('.get').width() / ( 1920 / 278 ));
//     alert($('.get').height());
// }

  //     var mobile_prtscn_width  = $('.am-max540').width();
  // var mobile_views_width   =  mobile_prtscn_width;
  // var mobile_views_heigth  =  mobile_views_width / (1200 / 220);
  // $('.am-bottom-don2').css({'height':mobile_views_heigth,'width':mobile_views_width});
$(window).resize(function(){
$('.am_listimg_info .am_imglist_time').css('display', $('.am_list_block').width() <= 170 ?  'none' : 'block');
});

//@首页 图片滑动效果
$(".am_list_block").on('mouseover', function(){
    $('.am_img_bg').removeClass('am_img_bg');
    $(this).find('.am_img').addClass('bounceIn');
});
$('.am_img').on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
    $('.am_img').removeClass('bounceIn');
});
if($(window).width() < 700 ){
  $('.am_list_block').off();
}

//@首页 底部下载按钮

   // function mouse_over_out(obj, style, overcss, outcss) {
   //      obj.bind('mouseover', function() {
   //          $(this).css(style, overcss);
   //      });
   //      obj.bind('mouseout', function() {
   //          $(this).css(style, outcss);
   //      });
   //  }



//@首页 图片列表长宽相等

$(window).resize(function(){
// $('.am_img_bg').height($('.am_img_bg').width());
});

//@懒加载
  $("img.am_img").lazyload();
  $("a.am_img_bg").lazyload({
  effect : 'fadeIn'
});

});



