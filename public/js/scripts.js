
    (function($) {
    "use strict";
    $(document).ready(function() {
      $('#example-getting-started').multiselect({
        buttonWidth: '100%',
        widthSynchronizationMode: 'always',
      });
    });
    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    // $("#sidebarToggle").on("click", function(e) {
    //     e.preventDefault();
    //     $("body").toggleClass("sb-sidenav-toggled");
    // });

    $(".faq-a").click(function(){
        $(".faq-a").toggleClass("show");
        $(".main-lb-a").toggleClass("lb-show");
      })
      $(".faq-b").click(function(){
        $(".faq-b").toggleClass("show");
        $(".main-lb-b").toggleClass("lb-show");
      })
      $(".faq-c").click(function(){
        $(".faq-c").toggleClass("show");
        $(".main-lb-c").toggleClass("lb-show");
      })
      $(".faq-d").click(function(){
        $(".faq-d").toggleClass("show");
        $(".main-lb-d").toggleClass("lb-show");
      })
      $(".faq-e").click(function(){
        $(".faq-e").toggleClass("show");
        $(".main-lb-e").toggleClass("lb-show");
      })
      $(".faq-f").click(function(){
        $(".faq-f").toggleClass("show");
        $(".main-lb-f").toggleClass("lb-show");
      })
      $('.dropdown-toggle').on('click',function(){
        $('.dropdown-menu.dropdown__menu-right').toggle();
      })
      $('.dropdown-item').on('click',function(){
        $('.dropdown-menu.dropdown__menu-right').toggle();
      })
      $(document).ready(function(){
        $('#table').DataTable();
      });      
})(jQuery);
