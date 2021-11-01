// Find all iframes
var $iframes = $( "iframe" );

// Find & save the aspect ratio for all iframes
$iframes.each(function () {
    $( this ).data( "ratio", this.height / this.width )
        // Remove the hardcoded width & height attributes
        .removeAttr( "width" )
        .removeAttr( "height" );
});

// Resize the iframes when the window is resized
$( window ).resize( function () {
    $iframes.each( function() {
// Get the parent container's width
        var width = $( this ).parent().width();
        $( this ).width( width )
            .height( width * $( this ).data( "ratio" ) );
    });
// Resize to fix all iframes on page load.
}).resize();



// Open external links in a new window or tab
$(document).on('click', 'a[rel$="external"]', function() {
    $(this).attr('target', "_blank");
});

$(document).on('click', 'a[href$=".pdf"]', function() {
    $(this).attr('target', "_blank");
});

// Open all urls that don't belong to our domain in a new window or tab
$(document).on('click', "a[href^='http:']:not([href*='" + window.location.host + "'])", function() {
    $(this).attr("target", "_blank");
});


$(document).ready(function() {
    if(!$("#user_email-29").val()){
        $("#um-submit-btn").attr("disabled", true);
    }
});
$("#user_email-29").on('input',function(){
    if($("#user_email-29").val()){
        $("#um-submit-btn").attr("disabled", false);
    }else{
        $("#um-submit-btn").attr("disabled", true);
    }
});



$(document).ready(function() {

    $(".wp-caption").removeAttr("style");



    // Add minus icon for collapse element which is open by default
    $(".accordion .collapse.show").each(function(){
        $(this).prev(".card-header").find(".fas").addClass("collapse-icon-minus").removeClass("collapse-icon-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".accordion .collapse").on('show.bs.collapse', function(){
        $(this).prev(".card-header").find(".fas").removeClass("collapse-icon-plus").addClass("collapse-icon-minus");
    }).on('hide.bs.collapse', function(){
        $(this).prev(".card-header").find(".fas").removeClass("collapse-icon-minus").addClass("collapse-icon-plus");
    });


    /*

    $('.gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300,
            opener: function (element) {
                return element.find('img');
            }
        }

    });
    */

    $('.gallery').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
    });





    $('.foto').magnificPopup({
        type: 'image',
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function (element) {
                return element.find('img');
            }
        }
        // other options
    });



});
const slider = document.querySelector(".homepage-swiper");
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener("mousedown", e => {
    isDown = true;
    slider.classList.add("active");
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener("mouseleave", () => {
    isDown = false;
    slider.classList.remove("active");
});
slider.addEventListener("mouseup", () => {
    isDown = false;
    slider.classList.remove("active");
});
slider.addEventListener("mousemove", e => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = x - startX;
    slider.scrollLeft = scrollLeft - walk;
});