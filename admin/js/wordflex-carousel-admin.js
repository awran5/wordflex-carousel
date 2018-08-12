/*!
  * WordFlex Carousel Main script
  */
(function( $ ) {
    'use strict';

    // Shortcode copy link
    var shortcodeInput = $('.shortcode-input');
    shortcodeInput.attr('size', function() {
        return $(this).val().length;
    }); 
    // Shortcode copy link
    $('.copy-to-clipboard .copy').click(function(e) {
        e.preventDefault();
        shortcodeInput.focus().select();
        document.execCommand('copy');
        $('.copied').show().fadeOut(2000);
    });

    // CMB2 range
    // $('.cmb2-range').each(function() {
    //     var span = $('.range-value');
    //     span.html('<strong>' + $(this).val() + '</strong>' );
    //     // Append the range value to each slider 
    //     $(this).on('input', function() {
    //     // update to the dynamic value
    //     span.html('<strong>' + $(this).val() + '</strong>' );
    //     });           
    // });


})( jQuery );



