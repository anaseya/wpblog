
jQuery(document).ready(function($) {


    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });

    readLessMore();

    tinymce.init({
        menubar: false,
        selector: '#blogtextarea',
        //entity_encoding : "raw",
        toolbar_items_size: 'small',
        br_in_pre: false,
        forced_root_block : 'p',
        end_container_on_empty_block: true,
        default_link_target: "_blank",
        link_assume_external_targets: true,
        link_title: false,
        style_formats: [
            {title: 'h2', block: 'h2'},
            {title: 'h3', block: 'h3'},
            {title: 'Simple text', block: 'p'},
            {title: 'Preformatted text', block: 'pre'},
           ],
        plugins: ["link image hr imagetools textcolor wordcount"],// contextmenu
        toolbar: "undo redo | styleselect hr bold | alignleft aligncenter bullist indent  outdent | link | image | forecolor"

    });

    $("#blogSubmit").click(function(event){

        event.preventDefault();

        var getTinyMceContent = tinymce.activeEditor.getContent({format : 'raw'});
        var countedWords       = $('label.mce-wordcount').text();

        $.ajax({
            type: 'POST',
            url : '/wp-admin/admin-ajax.php',
            cache : false,
            dataType : "html",
            data: {
                action: 'blog_form_ajax_callback',
                blogform: 'newpost',
                _wpnonce: $("#_wpnonce").val(),
                _wp_http_referer: $('input[name=_wp_http_referer]').val(),
                post_title: $("#post-title").val(),
                blogtextarea: getTinyMceContent,
                count_words: countedWords
            },
            success: function(response, textStatus, XMLHttpRequest) {

                var obj = jQuery.parseJSON(response);
                if ( obj.status > 0 ) {
                    $('#ajax9382').html('');
                    $('#ajax9382').html(obj.page_src);
                    responseMsg(obj.msg,'success');
                    resetForm();
                    readLessMore();
                }
                else {
                    responseMsg(obj.msg,'danger');
                }
            },
            error : function(XMLHttpRequest, ajaxOptions, thrownError) {
                alert('status Code:' + XMLHttpRequest.status + 'Error Message :'
                + thrownError);
            },
            complete: function(xml, status){
                 // do something after success or error no matter what
            }
        });
    })

    $("#comsubmit").click(function(event){//todo finish the custom post for comments

        event.preventDefault();
        var commentform=$('form[action$=wp-comments-post.php]');   //- See more at: http://webdeveloperplus.com/wordpress/how-to-ajaxify-wordpress-comment-posting/#sthash.rhlp7liB.dpuf
        var formdata=commentform.serialize();
        $.ajax({
            type: 'POST',
            url : commentform.attr('action'),
            cache : false,
            dataType : "html",
            data: {
                action: 'comment_form_ajax',
                commentform: commentform.serialize()
            },
            success: function(response, textStatus, XMLHttpRequest) {

                var obj = jQuery.parseJSON(response);
                if ( obj.status > 0 ) {
                    $('#ajax9382').html('');
                    $('#ajax9382').html(obj.page_src);
                    responseMsg(obj.msg,'success');
                    resetForm();
                    readLessMore();
                }
                else {
                    responseMsg(obj.msg,'danger');
                }
            },
            error : function(XMLHttpRequest, ajaxOptions, thrownError) {
                alert('status Code:' + XMLHttpRequest.status + 'Error Message :'
                + thrownError);
            },
            complete: function(xml, status){
                 // do something after success or error no matter what
            }
        });
    })

    function readLessMore() {
        $('.content').hide();
        $('a.view').click(function () {
            $(this).closest('.listposts').find('.excerpt').hide();
            $(this).closest('.listposts').find('.content').show();
            return false;
        });
        $('a.view-less').click(function () {
            $(this).closest('.listposts').find('.content').hide();
            $(this).closest('.listposts').find('.excerpt').show();
            return false;
        });
    }

    function responseMsg( msg, type ) {
        var div_alert = $('div.alert')[0];
        (typeof div_alert === "undefined") ? true : $('div.alert').remove().end();
        $('div.ajx-err').after('<div class="alert alert-'+ type +'">' +
        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
        msg +
        '</div>');

        return true;
    }

    function resetForm() {
        $('#post-title').val('');
        tinymce.activeEditor.setContent('');
    }
});

