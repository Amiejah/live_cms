/**
 * plugin.js
 *
 * Copyright, Amir Swaleh
 * Released under Creative Commons Attribution-NonCommercial 3.0 Unported License.
 *
 * Contributing: https://github.com/Amiejah/live_cms
 */


tinymce.PluginManager.add('top_widget', function(editor) {
    // Retrieve the data
    // Create a table based on the data
    function createHTMLtable(){

        var tbl = '',
            i = 0,
            c = 1;
        $.ajax({
            url: "/admin/casino/retrieve_data",
            type: "GET",
            async: false,
            dataType: "json",
            success: function (data) {

                tbl += '<table class="table top_widget">';
                tbl += '<thead>';
                tbl += '<tr>';
                tbl += '<th class="widget_count hidden-xs">#</th>';
                tbl += '<th class="widget_title">Casino</th>';
                tbl += '<th class="widget_ratings hidden-xs">Rating</th>';
                tbl += '<th class="widget_bonus">Welkomst bonus</th>';
                tbl += '<th class="widget_download hidden-xs">Download/review</th>';
                tbl += '</tr>';
                tbl += '</thead>';
                tbl += '<tbody>';
                $.each(data, function() {
                    if( data[i]['widget_status'] == 1) {
                        tbl += '<tr>';
                        tbl += '<td class="widget_count hidden-xs">' + c + '</td>';
                        tbl += '<td class="widget_title">';
                        tbl += '<span>';
                        tbl += '<img src="../../../images/' + data[i]['widget_image_upload'] + '" title="' + data[i]['widget_title'] + '" alt="' + data[i]['widget_title'] + '"/>';
                        tbl += '</span>';
                        tbl += data[i]['widget_title'];
                        tbl += '</td>';
                        tbl += '<td class="widget_ratings hidden-xs">' +  data[i]['widget_ratings'] + '</td>';
                        tbl += '<td class="widget_bonus">' + data[i]['widget_bonus'] + '</td>';
                        tbl += '<td class="widget_download hidden-xs">';
                        tbl += '<a href="' + data[i]['widget_external_url'] + '" target="_blank">';
                        tbl += '<i class="fa fa-download">&nbsp;</i>';
                        tbl += '</a>';
                        tbl += '<a href="casino/' + data[i]['widget_id'] + '/' + data[i]['widget_slug'] + '">Review</a>';
                        tbl += '</td>';

                        tbl += '</tr>';
                    }
                    i++;
                    c++;
                });
                tbl += '</tbody>';

                tbl += '</table>';
            }

        });

        return tbl;
    }


    // Add a menu item to the toolbar
    editor.addMenuItem('top_widget', {
        text: 'Add Widget',
        context: 'tools',
        onclick: function(){
            tinymce.activeEditor.execCommand(
                'mceInsertContent',
                true,
                createHTMLtable()
            );
        }
    });

});