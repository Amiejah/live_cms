$( document ).ready( function(){
    if( $( '#orderResult' ).length ) {
        $.post( '/admin/page/order_ajax', {}, function( data ){
            $( '#orderResult' ).html( data );
            $( '.sortable' ).nestedSortable({
                handle: 'div',
                items: 'li',
                toleranceElement: '> div',
                maxLevels: 2
            });
        });
    }

    // Ajax submit page order
    $( '#save' ).on( 'click', function(){
        var oSortable = $( 'ol.sortable' ).nestedSortable('toArray');

        $( '#orderResult' ).slideUp( function(){
            $.post( '/admin/page/order_ajax', { sortable: oSortable }, function( data ){
                $( '#orderResult' ).html( data );
                $( '#orderResult' ).slideDown();
            });
        });
    });


    // Check for the datepicker
    if( $( 'input.datepicker').length ){
        $( 'input.datepicker' ).datepicker({
            format: 'yyyy-mm-dd'
        });
    }
});

tinymce.init({
    selector: "textarea.mce",
    theme: 'modern',
    skin: 'light',
    plugins: 'code top_widget emoticons table spellchecker responsivefilemanager',
    tools: 'table',
    toolbar: "bold,italic,underline,strikethrough,separator,justifyleft,justifyright,justifycenter,justifyfull,separator,bullist, numlist,outdent,indent,separator,cut,copy,paste,separator,unlink,link,separator,phpimage,separator,formatselect,code,fullscreen, responsivefilemanager top_widget",
    theme_advanced_blockformats : "h2,h3,h4,blockquote,dt,dd",
    image_advtab: true,
    theme_advanced_toolbar_align : "left",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    external_filemanager_path:"http://stickymatje.nl/js/admin/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "http://stickymatje.nl/js/admin/filemanager/plugin.min.js"}
});