(function() {
    tinymce.PluginManager.add('merola_tc_button', function( editor, url ) {
        editor.addButton( 'merola_tc_button', {
            title: 'Merola Shortcodes',
            type: 'menubutton',
            icon: 'icon merola-icon',
            menu: [

                {
                    text: 'Tooltip',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Tooltip Panel',
                            body: [{
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: '',
                                minWidth: 350,
                            },
                                {
                                    type: 'textbox',
                                    name: 'content',
                                    label: 'Content',
                                    minWidth: 350,
                                    minHeight: 150
                                }

                            ],
                            onsubmit: function( e ) {
                                editor.insertContent('[tooltip title="' + e.data.title + '" content="' + e.data.content + '" ]');
                            }
                        });
                    }
                },

            ]
        });
    });
})();
