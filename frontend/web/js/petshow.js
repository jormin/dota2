$(function(){
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

    //@懒加载
      $("img.am_img").lazyload();
      $("a.am_img_bg").lazyload({
      effect : 'fadeIn'
    });

});



