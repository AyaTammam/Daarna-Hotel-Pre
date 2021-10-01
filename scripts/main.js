$(function () {

    // Nice Scroll
    // $("html").niceScroll();

    // Scroll Top
    var scrollButton = $("#scroll-top");
    $(window).scroll(function ()
    {
        
        if ($(this).scrollTop() >= 400) {
            
            scrollButton.show();
            
        } else {
            
            scrollButton.hide();
        }
    });
    scrollButton.click(function ()
    {
        
        $("html,body").animate({ scrollTop : 0 }, 600);
        
    });

    // Hide Placeholder On Form Focus
    $('[placeholder]').focus(function () { 
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });

    // $('.navbar ul li').click(function () { 
    //     $(this).addClass('active').siblings().removeClass('active');
    //     console.log($(this));
    // });
});