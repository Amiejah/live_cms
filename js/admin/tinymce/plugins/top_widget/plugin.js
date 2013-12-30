/**
 * plugin.js
 *
 * Copyright, Amir Swaleh
 * Released under Creative Commons Attribution-NonCommercial 3.0 Unported License.
 *
 * Contributing: https://github.com/Amiejah/live_cms
 */


tinymce.PluginManager.add('top_widget', function(editor) {
    // Add a menu item to the toolbar
    editor.addMenuItem('top_widget', {
        text: 'Add Widget',
        context: 'tools',
        onclick: function(){
            // Open window with a specific url
            editor.windowManager.open({
                title: 'TinyMCE Site',
                url: 'http://www.tinymce.com',
                width: 800,
                height: 600,
                buttons: [{
                    text: 'close',
                    onclick: 'close'
                }]
            });
        }
    });

});