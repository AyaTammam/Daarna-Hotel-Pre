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
    // $('[placeholder]').focus(function () { 
    //     $(this).attr('data-text', $(this).attr('placeholder'));
    //     $(this).attr('placeholder','');
    // }).blur(function(){
    //     $(this).attr('placeholder',$(this).attr('data-text'));
    // });

    // Remove Class Active Form Navlinks
    // $('.navbar ul li').click(function () { 
    //     $(this).addClass('active').siblings().removeClass('active');
    //     console.log($(this));
    // });

    // Open Sidebar
    var sidebarOpen = $('.sidebar-open-btn'),
    sidebar = $('#sidebar');
    if (sidebarOpen) {
        sidebarOpen.click(function () {
            $(".sidebar").niceScroll();
            sidebarOpen.addClass('active');
            sidebar.addClass('open');
            $('body').css('overflow', 'hiden');
            $('#sidebar .overlay').click(function () {
                // $(".sidebar").getNiceScroll().hide();
                sidebarOpen.removeClass('active');
                sidebar.removeClass('open');
                $('body').css('overflow', 'unset');
            })
        })
    }

    // Open Sidebar java Script
    // let sidebarOpen = document.querySelector('.sidebar-open-btn'),
    // sidebar = document.querySelector('#sidebar');
    // if (sidebarOpen) {
    //     sidebarOpen.onclick = () => {
    //         sidebarOpen.classList.add('active');
    //         sidebar.classList.add('open');
    //         document.body.style.overflow = 'hidden';
    //         sidebar.querySelector('.overlay').onclick = () => {
    //             sidebarOpen.classList.remove('active');
    //             sidebar.classList.remove('open');
    //             document.body.style.overflow = 'unset';
    //         }
    //     }
    // }
});