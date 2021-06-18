CKEDITOR.plugins.add('coderojpreview', {
    icons: 'coderojpreview',
    init: function(editor) {
        editor.addCommand('previewEditor', {
            exec: function(editor) {
                var now = new Date();
                var modal = new Modal("custom", 750);
                modal.open("Preview");
                modal.html(editor.getData());
                if (typeof MathJax !== 'undefined') {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            }
        });
        editor.ui.addButton('CoderojPreview', {
            label: 'Preview Editor',
            command: 'previewEditor',
            toolbar: 'insert'
        });
    }
});