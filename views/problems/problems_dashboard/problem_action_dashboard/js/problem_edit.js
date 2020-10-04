

function setUpEditor(){
  
  problemEditor.setUpEditorFunation();

  setTimeout(function(){ 
    $("#problemEditBodyLoader").hide();
    $("#problemEditBody").show();
  }, 1000);

}


var problemEditor = {
  constraintsEditor : "" , 
  inputEditor : "" , 
  outputExEdito : "", 
  descriptionEdito : "", 
  noteEditor : "" ,  
  setUpEditorFunation: function(){
    this.descriptionEditor = CKEDITOR.replace('descriptionEditor');
    this.inputEditor = CKEDITOR.replace('inputEditor');
    this.outputEditor = CKEDITOR.replace('outputEditor');
    this.noteEditor = CKEDITOR.replace('noteEditor');
    this.constraintsEditor = CKEDITOR.replace('constraintsEditor');

  //set global data
    CKEDITOR.config.height = 100;
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.extraPlugins = 'mathjax,autogrow,justify,image2';
    CKEDITOR.config.mathJaxLib = 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
    CKEDITOR.config.mathJaxClass = 'equation';
    CKEDITOR.config.codeSnippet_theme = 'pojoaque';
    CKEDITOR.config.fontSize_defaultLabel = '12px';
    CKEDITOR.config.disableObjectResizing = false;
    CKEDITOR.config.autoGrow_minHeight = 100;
    CKEDITOR.config.autoGrow_maxHeight = 300;
    CKEDITOR.config.tabSpaces = 4;
    this.setEditorToolbar();
    this.setUpEditorData();
  },

  setEditorToolbar : function(){
      var toolbarConstraintsEditor = [
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo'],
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
          name: 'editing',
          groups: ['find', 'selection', 'spellchecker'],
          items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
        },
        {
          name: 'others',
          items: ['-']
        },
        {
          name: 'Math',
          items: ['Mathjax']
        },
        {
          name: 'basicstyles',
          groups: ['basicstyles', 'cleanup'],
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']
        }
      ];

      var toolbarInputExEditor = [{
        name: 'clipboard',
        groups: ['clipboard', 'undo'],
        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
      }];

      this.constraintsEditor.config.toolbar = toolbarConstraintsEditor;
      this.inputEditor.config.toolbar = toolbarConstraintsEditor;
      this.outputEditor.config.toolbar = toolbarConstraintsEditor;
  },
  setUpEditorData : function(){
    problemData = window.atob(problemData);
    problemData = JSON.parse(problemData);
    problemId = problemData.problemId;
    CKEDITOR.instances.descriptionEditor.setData(problemData.problemDescription);
    CKEDITOR.instances.inputEditor.setData(problemData.inputDescription);
    CKEDITOR.instances.outputEditor.setData(problemData.outputDescription);

    CKEDITOR.instances.noteEditor.setData(problemData.notes);
    CKEDITOR.instances.constraintsEditor.setData(problemData.constraintDescription);
  },
  getEditorData : function(){
    var editorData = {
      'problemId': problemId,
      'problemDescription': CKEDITOR.instances.descriptionEditor.getData(),
      'inputDescription': CKEDITOR.instances.inputEditor.getData(),
      'outputDescription': CKEDITOR.instances.outputEditor.getData(),
      'notes': CKEDITOR.instances.noteEditor.getData(),
      'constraintDescription': CKEDITOR.instances.constraintsEditor.getData()
    }
    return editorData;
  }

};

function uploadImage(){
  modal_action("lg", "Upload Image");
  loader("modal_lg_body");
  $.post(dashboard_action_url, buildProblemData("uploadImage", problemEditor.getEditorData()), function (response) {
    $("#modal_lg_body").html(response);
  });
}

function previewProblem() {
  modal_action("lg", "Problem Preview");
  loader("modal_lg_body");
  $.post(dashboard_action_url, buildProblemData("previewProblem", problemEditor.getEditorData()), function (response) {
    
      $("#modal_lg_body").empty().append("<p>"+response+"</p>");
  });
}

function updateProblem() {
  btnOff("btn_update_problem", "Saving....");
  $.post(dashboard_action_url, buildProblemData("updateProblem", problemEditor.getEditorData()), function (response) {
    toast.success("Problem Update Successfully");
    btnOn("btn_update_problem","Save Change");
  });
}
