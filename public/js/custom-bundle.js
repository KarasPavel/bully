if (!String.prototype.format) {
    String.prototype.format = function() {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function(match, number) {
            return typeof args[number] != 'undefined'
                ? args[number]
                : match
                ;
        });
    };
}

$(document).ready(function() {
    $(".picker").datepicker({
      showAnim: "slideDown",
      dateFormat: "dd M yy",
      duration: 450
  });
    function touch() {
        var el = $("body");
        el.addEventListener("touchstart", handleStart, false);
        el.addEventListener("touchend", handleEnd, false);
        el.addEventListener("touchcancel", handleCancel, false);
        el.addEventListener("touchmove", handleMove, false);
        log("initialized.");
    }
    $(".first-screen-wrapper").click(function(){
        if($(".burger-wrap").hasClass("open-menu")){
            $('.burger-wrap').removeClass("open-menu");
            $('.bottom-part-menu').removeClass("open-burg-menu");
        }
    });
    if(!($(".first-screen-wrapper").length)){
        $(".menu").addClass("scroll-down");
    }

    if($(".wrapper-stick").length){
        $(window).scroll(function(){
            var scrollMenu = $(".menu").offset().top + $(".menu").innerHeight();
            var scrollitem1 = $(".filter-head h2").offset().top;
            var scrollitem2 = $(".filter-w").offset().top;
            var offItem = $(".menu").innerHeight() + $(".filter-w").innerHeight();
            // if(scrollMenu >= scrollitem1){

            //     $(".filter-head").addClass("hidden");
            // }
            // if(scrollMenu >= scrollitem2){
            //     if(!($(".filter-w").hasClass("scroll"))){
            //         $(".wrapper-filter").addClass("scroll");
            //         $(".filter-w").addClass("scroll");
            //         $('html, body').animate({ scrollTop: $("#stick-w").offset().top - offItem}, 0);
            //     }
            // }
            // if(scrollMenu < scrollitem1){
            //     if($(".filter-head.hidden")){
            //         $(".filter-head").removeClass("hidden");
            //     }
            // }
            if($(window).scrollTop() > 100){
                $(".menu").addClass("scroll-down");
            }
            else{
                $(".menu").removeClass("scroll-down");
            }
        });
    }

    if($(".f-w").length){
        $(".f-w").each(function(i){
            $(this).attr("data-number", i + 1);
            $(".f-w[data-number = 1]").addClass("current");

            var nextSlide = (Number($(".current").attr("data-number"))) + 1;
            var prewSlide = $(".f-w").length;
            $(".f-w[data-number = " + nextSlide + "]").addClass("next-slide");
            $(".f-w[data-number = " + prewSlide + "]").addClass("prew-slide");
        });
        for(i = 1; i<=4; i++){
            $(".next-slide .orig").clone().removeClass("orig").addClass("copy copy-" + i).appendTo(".next-slide");
        }
        $(window).trigger("scroll");
    }
});

// $(".description").keyup(function() { 
//     var description = $(".description").text().length 
//     if (description > 0){ 
//         $("#description-plh").removeClass("description-plh"); 
//     } 
//     else{ 
//         $("#description-plh").addClass("description-plh"); 
//     } 
// });
$(".description").focus(function() {
    $("#description-plh").removeClass("description-plh");
});

$(".description").focusout(function() {
    var description = $(".description").text().length;
    if (description < 1){ 
        $("#description-plh").addClass("description-plh");
    } 
    

});

$(".title_for_cover").focus(function() {
    $("#title_for_cover-plh").removeClass("title_for_cover-plh");
});

$(".title_for_cover").focusout(function() {
    var description = $(".title_for_cover").text().length;
    if (description < 1){ 
        $("#title_for_cover-plh").addClass("title_for_cover-plh");
    }
    

});

$(".add-new-com").focus(function() {
    $("#add-new-com").removeClass("add-new-com-plh");
});

$(".add-new-com").focusout(function() {
    var description = $(".add-new-com").text().length;
    if (description < 1){ 
        $("#add-new-com").addClass("add-new-com-plh");
    }
    

});

// $(".delete-1").click(function(e){
//     e.preventDefault;
//         $("#delete-1").val("");
//     });



var flag = 1;


var elemS;


function nextEv(){
    if(flag == 1){
        flag = 0;
        $(".next-slide").addClass("animate");
        var curNum = $(".animate").attr("data-number");
        
        setTimeout(function(){
            if(+($(".next-slide").attr("data-number")) == $(".f-w").length){
                $(".f-w").removeClass("current");
                $(".f-w").removeClass("prew-slide");
                $(".f-w[data-number = 1]").addClass("next-slide");

                $(".f-w[data-number = " + (+curNum - 1) + "]").addClass("prew-slide");
                $(".animate").removeClass("next-slide");
                $(".animate").addClass("current");
                $(".f-w").removeClass("animate");
                $(".copy").remove();
                for(i = 1; i<=4; i++){
                    $(".next-slide .orig").clone().removeClass("orig").addClass("copy copy-" + i).appendTo(".next-slide");
                }
            }
            else{
                $(".f-w").removeClass("current");
                $(".f-w").removeClass("prew-slide");
                $(".f-w[data-number = " + (+curNum + 1) + "]").addClass("next-slide");
                if(+($(".animate").attr("data-number")) == 1){
                    $(".f-w[data-number = " + $(".f-w").length + "]").addClass("prew-slide");
                }
                else{
                    $(".f-w[data-number = " + (+curNum - 1) + "]").addClass("prew-slide");
                }
                $(".animate").removeClass("next-slide");
                $(".animate").addClass("current");
                $(".copy").remove();
                $(".f-w").removeClass("animate");
                for(i = 1; i<=4; i++){
                    $(".next-slide .orig").clone().removeClass("orig").addClass("copy copy-" + i).appendTo(".next-slide");
                }
            }
            flag = 1;
            $("body").trigger("mouseleave");
        },1300);
    }
}

// 

var body = $('body');
var btnI, posGradient;

// function getPosGradient(btnI, btnMouseX, btnMouseY){
//     return [btnI.data('x') - btnMouseX, btnI.data('y') - btnMouseY];
// }

// body.on('mouseenter', '.btns', function(e){

//     btnI = $(this).find('i');
//     btnI.data('x', btnI.position().left + btnI.width() / 2).data('y', btnI.position().top + btnI.height() / 2);
//     $(this).data('x', $(this).offset().left).data('y', $(this).offset().top);
//     posGradient = getPosGradient(btnI, e.pageX - $(this).data('x'), e.pageY - $(this).data('y'));
//     TweenMax.to(btnI, 0.5, {x: - posGradient[0] + 'px', y: - posGradient[1] + 'px'});

// }).on('mousemove', '.btns', function(e){

//     btnI = $(this).find('i');
//     posGradient = getPosGradient(btnI, e.pageX - $(this).data('x'), e.pageY - $(this).data('y'));
//     if(!TweenMax.isTweening(btnI)){
//         TweenMax.set(btnI, {x: - posGradient[0] + 'px', y: - posGradient[1] + 'px'});
//     }

// }).on('mouseleave', '.btns', function(){

//     TweenMax.to($(this).find('i'), 0.5, {x: '0px', y: '0px'});

// });


// if($(".first-screen-wrapper").length){
//     var curImg;
//     var hCenter;
//     var wCenter;
//     var tr;
//     var curImg;
//     var trX;
//     var trY;
//     var scrollFirst = $(".first-screen-wrapper").innerHeight();


//     $(document).on('mouseenter', '.first-screen-wrapper', function(e){
//         if($(window).innerWidth() > 980){
//             if($(window).scrollTop() < scrollFirst){
//                 curImg = $(".current").find(".img-wrap");
//                 curImg.find("img").css("transition", ".1s linear");
//                 wCenter = curImg.innerWidth() / 2;
//                 hCenter = curImg.innerHeight() / 2;

//         // console.log(curImg.find("img").css("transition", ".1s ease-out"));
//         setTimeout(function(){

//             curImg.find("img").css("transition", "");
//         },110);
//     }
// }
// }).on('mousemove', '.first-screen-wrapper', function(e){
//     if($(window).innerWidth() > 980){
//         if($(window).scrollTop() < scrollFirst){
//             curImg = $(".current").find(".img-wrap");
//             trX = ((e.pageY - hCenter) / hCenter) * 7;
//             trY = ((e.pageX - wCenter) / wCenter) * 7;
//             curImg.find("img").css("transform", "rotateX(" + trX + "deg) rotateY(" + trY + "deg) scale(1.4) translateZ(-15vw)" );
//         }
//     }
// });
// }


$(".text-wrap").keyup(function(){
    var op = $(".text-wrap").text().length;
    if (op > 0){
        $("#op").removeClass("level");
    }
    else{
        $("#op").addClass("level");
    }
});

if($(".first-screen-wrapper").length){

    var touchMouse;
    var touchStart;
    var endCoord = $(".arrow-btn").offset().left;
    var pos;
    var nextSl;


    $(".the-slider").mousedown(function(e){
        touchMouse = 1;
        $("body").addClass("touch");
        $(".the-slider").addClass("touch");
        $(".drag-wrap p").css("opacity", "0");
        touchStart = e.pageX;
        $(".first-screen-wrapper").on("mousemove", function(e){
            if(e.pageX > touchStart && touchMouse == 1){
                pos = (e.pageX - touchStart) * 0.9;
                if(pos > 185){
                    nextSl = 1;
                    $(".the-slider").removeClass("touch");
                    $(".the-slider").attr("style", "").addClass("go");
                }
                if(pos < 185){
                    $(".the-slider").removeClass("go");
                    $(".the-slider").css("transform", "translateX(" + pos + "px) scale(.7)").css("transition", "0.01s ease-out");
                    nextSl = 0;

                }
            }
        });
    });

    var touch;
    var nextpos;


    $("body").mouseleave(function(){
        nextSl = 0;
        $(".drag-wrap p").attr("style", "");
        $(".the-slider").attr("style", "");
        $(".the-slider").removeClass("go touch");
        $("body").removeClass("touch");
        $(".first-screen-wrapper").unbind("mousemove");
    });

    $("body").mouseup(function(){
        $(".drag-wrap p").attr("style", "");
        if(nextSl == 1){
            nextSl = 0;
            nextEv();
            touchMouse = 0;
            $(".drag-wrap").addClass("ns");
            $(".first-screen-wrapper").unbind("mousemove");

            setTimeout(function(){

                $(".the-slider").attr("style", "");
                $("body").removeClass("touch");
                $(".the-slider").removeClass("touch");
                $(".the-slider").removeClass("go");
                $(".drag-wrap").removeClass("ns");
            },510);
        }
        else{
            $(".the-slider").attr("style", "");
            $("body").removeClass("touch");
            $(".the-slider").removeClass("touch");
            $(".first-screen-wrapper").unbind("mousemove");
        }
    });
    if($(window).innerWidth() < 980){
        $(".the-slider").on("touchstart", function(e){
            touchMouse = 1;
            touch=event.targetTouches[0];
            $(this).addClass("touch");
            touchStart = touch.pageX;
            nextpos = touchStart;
        });
        $(".drag-wrap").on("touchmove", function(e){
            nextpos += 1;
            if(nextpos > touchStart && touchMouse == 1){
                pos = (nextpos - touchStart) * 5;

                if(pos < 215){
                    $(".the-slider").css("transform", "translateX(" + pos + "px) scale(.3)");
                }
                if(pos > 155){
                 nextSl = 1;
             }
             if(pos < 155){
                nextSl = 0;
            }
        }
    });
        $("body").on("touchend", function(){
            if(nextSl == 1){
                nextSl = 0;
                nextEv();
                touchMouse = 0;
                $(".drag-wrap").addClass("ns");
                $(".drag-wrap").unbind("mousemove");
                setTimeout(function(){
                    $(".the-slider").attr("style", "").removeClass("touch");
                    $(".drag-wrap").removeClass("ns");
                },510);
            }
            else{
                $(".the-slider").attr("style", "").removeClass("touch");
                $(".drag-wrap").unbind("mousemove");
            }
        });


    }
}


var flagMen=1;


$(".element").click(function(){
    $(".filter-item").removeClass("active");
    var selectEl = $(this);
    if(flagMen == 1){
        flagMen=0;
        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $('.burger-part-menu').removeClass("open-burg-menu");
            $('.bottom-part-menu').removeClass("open-burg-menu");
            setTimeout(function(){
                flagMen=1;
            },750);
            return;
        }
        else if($(".element.active").length == 0){
            selectEl.addClass("active");
            setTimeout(function(){
                flagMen=1;
            },700);
            if(selectEl.hasClass("search")){
                $('.bottom-part-menu').addClass("open-burg-menu");
            }
            if(selectEl.hasClass("burger-wrap")){
                $('.burger-part-menu').addClass("open-burg-menu");

            }
            return;
        }
        else{
            $('.burger-part-menu').removeClass("open-burg-menu");
            $('.bottom-part-menu').removeClass("open-burg-menu");
            $(".element").removeClass("active");
            setTimeout(function(){
                selectEl.addClass("active");
                flagMen=1;
            },700);
            if(selectEl.hasClass("search")){
                setTimeout(function(){
                    $('.bottom-part-menu').addClass("open-burg-menu");
                },700);
            }
            if(selectEl.hasClass("burger-wrap")){
                setTimeout(function(){
                    $('.burger-part-menu').addClass("open-burg-menu");
                },700);
            }
            return;
        }
    }
});

// $(document).click(function(event) { 
//     if(!$(event.target).closest('.el').length){
//         console.log("aaa");
//         $('.burger-part-menu').removeClass("open-burg-menu");
//         $('.bottom-part-menu').removeClass("open-burg-menu");
//         $(".element").removeClass("active");
//         $(".filter-item").removeClass("active");
//         setTimeout(function(){
//             flagMen=1;
//         },700);
//     }
// });


$(".categ").click(function(){
    if($(this).hasClass("active")){
        $(this).removeClass("active");
        return;
    }
    $(this).addClass("active");
    $('.burger-part-menu').removeClass("open-burg-menu");
    $('.bottom-part-menu').removeClass("open-burg-menu");
    $(".element").removeClass("active");
});






// function bounce(timeFraction) {
//   for (var a = 0, b = 1, result; 1; a += b, b /= 2) {
//     if (timeFraction >= (7 - 4 * a) / 11) {
//       return -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) + Math.pow(b, 2);
//   }
// }
// }

// // преобразователь в easeOut
// function circ(timeFraction) {
//   return 1 - Math.sin(Math.acos(timeFraction))
// }


// var curImg;
// var hCenter;
// var wCenter;
// var tr;
// var curImg;
// var trX;
// var trY;
// var trYlast = 0;
// var trXlast = 0;
// var scrollFirst = $(".first-screen-wrapper").innerHeight();
// $(document).on('mouseenter', '.first-screen-wrapper', function(e){
//     wCenter = curImg.innerWidth() / 2;
//     hCenter = curImg.innerHeight() / 2;
//     curImg = $(".current").find(".img-wrap");
//     trX = ((e.pageY - hCenter) / hCenter) * 7;
//     trY = ((e.pageX - wCenter) / wCenter) * 7;
//     wCenter = curImg.innerWidth() / 2;
//     hCenter = curImg.innerHeight() / 2;
// });

// $(document).on('mousemove', '.first-screen-wrapper', function(e){
//     curImg = $(".current").find(".img-wrap");
//     // // curImg.find("img").css("transition", ".1s linear");

//     // curImg = $(".current").find(".img-wrap");
//     // trX = ((e.pageY - hCenter) / hCenter) * 7;
//     // trY = ((e.pageX - wCenter) / wCenter) * 7;
//       animate({
//         duration: 1000,
//         timing: function(timeFraction) {
//           return Math.pow(timeFraction, 1);
//         },
//         draw: function(progress) {
//           img.style.transform = "rotateX(" + (trX * progress) + "deg) rotateY(" + (trY * progress) + "deg) scale(1.4) translateZ(-15vw)";
//         // console.log(trYlast)
//       },
//   });

//   });
// debugger;

// $.datepicker.formatDate( "dd, M, yy");
// $('#picker').keydown(function(e){
//   console.log(e.key);
//   e.preventDefault();
// });

$(".slider").not('.slick-initialized').slick({
    infinite: true,
    slidesToShow:1,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000
});




$('.page-up a').on("click", function(e){
    e.preventDefault;
    var time = parseInt($("body").innerHeight() * 0.14);
    $('html, body').animate({scrollTop: 0}, time);
    return false;
});

// var scrollData = true;


// var downTo = $(window).scrollTop() - $(".wrapper-stick").offset().top;
// console.log(downTo)
// $(document).on("load", function(e){
//     console.log(downTo)
//     if(downTo > 196){
//         $(".wrapper-stick").css("transform", "translateY(-196px)")
//         scrollData = false;
//     }
// })


// $(document).scroll(function(){
//     console.log($(window).scrollTop());
//     console.log($(".wrapper-stick").offset().top);
//     if($(window).scrollTop() >= $(".wrapper-stick").offset().top && downTo < 196 && scrollData == true){
//         console.log(downTo);
//         $(".wrapper-stick").css("transform", "translateY(" + -downTo + "px)")
//     }
//     if(downTo > 196){
//         $(".wrapper-stick").css("transform", "translateY(-196px)")
//         scrollData = false;
//     }
// })


$('.first-screen-wrapper,  .img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig').height(window.innerHeight / 2 + 'px');
$('.caption-wrap, .img-wrap, .img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig').width(window.innerWidth + 'px');

$( window ).resize(function() {
    $('.first-screen-wrapper, .img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig ').height(window.innerHeight / 2 + 'px');
    $('.img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig ').width(window.innerWidth + 'px');
});

$(document).ready(function(){
    $('#dateStartInput').keypress(function(key){
        if(key.charCode < 2018 || key.charCode > 2100) return false;
    });
});

$(document).ready(function(){
    $('.burger-wrapper').click(function(){
            $('.burger-part-menu el').slideToggle('slow');
    });
});
$(document).ready(function(){
    $('#dateStart').keypress(function(key){
        if(key.charCode < 2018 || key.charCode > 2100) return false;
    });
    $('#dateEnd').keypress(function(key){
        if(key.charCode < 2018 || key.charCode > 2100) return false;
    });        
});

// $(document).ready(function () {
//     $('.w-d-c').css({'display': 'none'})
//     var clicks = 0;

//     $('.name').click(function() {
//         $(".w-d-c").toggle();
//         ++clicks;
//     });
// });


