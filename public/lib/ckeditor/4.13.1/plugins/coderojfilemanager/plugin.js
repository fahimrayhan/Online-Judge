CKEDITOR.plugins.add( 'coderojfilemanager', {
    icons: 'coderojfilemanager',
    init: function( editor ) {
        editor.addCommand( 'fileManager', {
            exec: function( editor ) {
                fileManager.selectImg(editor);
            }
        });
        editor.ui.addButton( 'CoderojFileManager', {
            label: 'File Manager',
            command: 'fileManager',
            toolbar: 'insert'
        });
    }
});

