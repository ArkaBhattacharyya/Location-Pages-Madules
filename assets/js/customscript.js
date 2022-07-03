
//     jQuery(function($){

//     // on upload button click
//     $('body').on( 'click', '.background-image', function(e){

//         e.preventDefault();

//         var button = $(this),
//         custom_uploader = wp.media({
//             title: 'Insert image',
//             library : {
//                 // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
//                 type : 'image'
//             },
//             button: {
//                 text: 'Use this image' // button label text
//             },
//             multiple: false
//         }).on('select', function() { // it also has "open" and "close" events
//             var attachment = custom_uploader.state().get('selection').first().toJSON();
//             button.html('<img src="' + attachment.url + '">').next().show().next().val(attachment.id);
//         }).open();
    
//     });

//     // on remove button click
//     $('body').on('click', '.misha-rmv', function(e){

//         e.preventDefault();

//         var button = $(this);
//         button.next().val(''); // emptying the hidden field
//         button.hide().prev().html('Upload image');
//     });

// });

jQuery(document).ready( function( $ ) {

    $('#upload_image_button').click(function() {

        formfield = $('#upload_image').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        window.send_to_editor = function(html) {
           imgurl = $(html).attr('src');
           $('#upload_image').val(imgurl);
           tb_remove();
        }

        return false;
    });

});
