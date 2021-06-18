var problemDetailsEditor = {
    constraintsEditor: "",
    inputEditor: "",
    outputExEditor: "",
    descriptionEditor: "",
    noteEditor: "",
    setEditor: function(problemData) {
        this.descriptionEditor = CKEDITOR.replace('descriptionEditor');
        this.inputEditor = CKEDITOR.replace('inputEditor');
        this.outputEditor = CKEDITOR.replace('outputEditor');
        this.noteEditor = CKEDITOR.replace('noteEditor');
        this.constraintsEditor = CKEDITOR.replace('constraintsEditor');
        //set global data
        this.setEditorConfig();
        this.setEditorToolbar();
        this.setEditorData(problemData);
    },
    setEditorConfig: function() {
        CKEDITOR.config.height = 100;
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        CKEDITOR.config.extraPlugins = 'mathjax,autogrow,justify,image2,div,coderojpreview,coderojfilemanager';
        CKEDITOR.config.mathJaxLib = 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
        CKEDITOR.config.mathJaxClass = 'equation';
        CKEDITOR.config.codeSnippet_theme = 'pojoaque';
        CKEDITOR.config.fontSize_defaultLabel = '12px';
        CKEDITOR.config.disableObjectResizing = false;
        CKEDITOR.config.autoGrow_minHeight = 100;
        CKEDITOR.config.autoGrow_maxHeight = 300;
        CKEDITOR.config.tabSpaces = 4;
    },
    setEditorToolbar: function() {
        var toolbarConstraintsEditor = [{
            name: "paragraph",
            items: ['Bold', 'Italic', 'Strike']
        }, {
            name: "paragraph",
            items: ["NumberedList", "BulletedList"]
        }, {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['CreateDiv', 'Link', 'Image', 'CoderojFileManager', 'Table', 'Mathjax']
        }, {
            name: "paragraph",
            items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        }, {
            name: 'tools',
            items: ['CoderojPreview', 'Maximize']
        }];
        var toolbarInputExEditor = [{
            name: "paragraph",
            items: ['Bold', 'Italic', 'Strike', 'Mathjax']
        }, {
            name: 'tools',
            items: ['CoderojPreview', 'Maximize']
        }];
        this.constraintsEditor.config.toolbar = toolbarInputExEditor;
        this.inputEditor.config.toolbar = toolbarInputExEditor;
        this.outputEditor.config.toolbar = toolbarInputExEditor;
        this.descriptionEditor.config.toolbar = toolbarConstraintsEditor;
        this.noteEditor.config.toolbar = toolbarConstraintsEditor;
    },
    setEditorData: function(problemData) {
        var problemData = JSON.parse(problemData);
        CKEDITOR.instances.descriptionEditor.setData(atob(problemData.problem_description));
        CKEDITOR.instances.inputEditor.setData(atob(problemData.input_description));
        CKEDITOR.instances.outputEditor.setData(atob(problemData.output_description));
        CKEDITOR.instances.constraintsEditor.setData(atob(problemData.constraint_description));
        CKEDITOR.instances.noteEditor.setData(atob(problemData.notes));
    },
    getEditorData: function() {
        var editorData = {
            'problem_description': CKEDITOR.instances.descriptionEditor.getData(),
            'input_description': CKEDITOR.instances.inputEditor.getData(),
            'output_description': CKEDITOR.instances.outputEditor.getData(),
            'notes': CKEDITOR.instances.noteEditor.getData(),
            'constraint_description': CKEDITOR.instances.constraintsEditor.getData()
        }
        return editorData;
    }
};