/**
 * plugin.js
 *
 * Copyright, Amir Swaleh
 * Released under Creative Commons Attribution-NonCommercial 3.0 Unported License.
 *
 * Contributing: https://github.com/Amiejah/live_cms
 */


tinymce.PluginManager.add('top_widget', function(editor) {

    function getHTTPObject()
    {
        var xhr = false;
        if (window.XMLHttpRequest)
        {
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            try
            {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch(e)
            {
                try
                {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    xhr = false;
                }
            }
        }
        return xhr;
    }

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
                        tbl += '<td class="widget_ratings hidden-xs">ratings</td>';
                        tbl += '<td class="widget_bonus">bonus</td>';
                        tbl += '<td class="widget_download hidden-xs">casino' + data[i]['widget_id'] + '/' + data[i]['widget_slug'] + '</td>';

                        tbl += '</tr>';
                    }

                    i++;
                    c++;
                });
                tbl += '</tbody>';

                tbl += '</table>';
            },
            error:function (xhr, ajaxOptions, thrownError){

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