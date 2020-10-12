$ = jQuery;



function menu_toggle(){

  $('body').toggleClass('menuActive');

}



$(function(){

  

    AOS.init();

  // $(".home-form-1 select").niceSelect();



  $('#editProfileform .custom-checkbox,#editProfileform .custom-radio, .jv-side .custom-radio, .jv-side .custom-checkbox').parent().addClass('pointer').click(function(){

    state = $(this).find('input').prop('checked');

    state = state == true ? false : true;

    $(this).find('input').prop('checked',state);
    $(this).find('input').trigger('change');

  });



  // $("select[multiple]").tagsinput();
  //   $('.similarProsSlider').owlCarousel({

  //       items: 3,

  //       loop:false,

  //       stagePadding: 25,

  //       margin:25,

  //       dots:true,

  //       nav:false,

  //       mouseDrag:false,

  //       responsive: {

  //           0:{items:1,margin:12},

  //           600:{items:1,margin:12},

  //           768:{items:2},

  //           1023:{items:3}

  //       }

  //   });



    // $('.serviceSlider').owlCarousel({

   //        items: 3,

   //        loop:true,

   //        dots:true,

   //        nav:true,

   //        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],

   //        responsive: {

   //            0:{items:1},

   //            600:{items:2},

   //            991:{items:3},

   //            1200:{items:3}

   //        }

   //    });



   $('.mainBlock .userSidebar li a').each(function(){

      var hrf = $(this).attr('href');

      if(window.location.href.indexOf(hrf) != -1){

        $(this).addClass('active');

      }

   });



});



// TO DISABLE COUNTER ONCE DONE

$(window).scroll(function(){

  $h = $('.siteHeader');

  if($(this).scrollTop() > $h.outerHeight()){

    $h.addClass('affix');

  } else{

    $h.removeClass('affix');

  }

});



$(window).on('load',function(){

    // $(".projectListing, .proGalleryListing").isotope();

});





 function loadModal(elem){

    $('.customModal').hide();

    $(elem).fadeIn();

}

function closeModal(elem){

    $(elem).fadeOut();

}



function startCounter() {

    if ($('.factsBlock').length > 0 && $(window).scrollTop() > $('.factsBlock').offset().top - $(window).height()) {

      console.log('worked');

        $(window).off("scroll", startCounter);

        $('.factsBlock h4').each(function () {

            var $this = $(this);

            jQuery({ Counter: 0 }).animate({ Counter: $this.attr('code') }, {

                duration: 2000,

                easing: 'swing',

                step: function () {

                    $this.text(numberWithCommas(Math.ceil(this.Counter)));

                }

            });

        });

        enableCounter = false;

    }

}

function numberWithCommas(x) {

    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}

$(document).ready(function(){
  $(".loginsideBar").click(function(){
    $("body").toggleClass("sidebaarActice");
  });
});
