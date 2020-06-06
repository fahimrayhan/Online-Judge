$(document).ready(function() {
    defineSourceCodeEditorTemplate();
    setSourceCodeEditor();
    setInitialLanguage();
    
});                   

var sourceCodeEditor;
var sourceCodeEditorTemplate;
var selectLanguage;
var selectLanguageId;
var isChangeTemplate = 0;


function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function changeTemplate(){
    isChangeTemplate = 1;
}

function setInitialLanguage(){
    cookieVal = getCookie("selectLanguage");
    //console.log(cookieVal);
    selectLanguage = cookieVal==""?1:cookieVal;
    $("#selectLanguage").val(selectLanguage).change();
    changeLanguage();
}

function changeLanguage(){
    selectLanguageId = $("#selectLanguage").val();

    if(selectLanguageId==1)selectLanguage = "c";
    else if(selectLanguageId>=2 && selectLanguageId<=3)selectLanguage = "cpp";
    else if(selectLanguageId==4)selectLanguage = "java";
    setCookie("selectLanguage",selectLanguageId,15);
    setEditorSelectLanguage();
    setEditorTemplate();
}

function setSourceCodeEditor(){
    sourceCodeEditor = ace.edit("sourceCodeEditor");
    sourceCodeEditor.setShowPrintMargin(false);
    sourceCodeEditor.setOption("maxLines", 27);                    
    sourceCodeEditor.setOption("minLines", 27);                    
    sourceCodeEditor.setReadOnly(false);
    sourceCodeEditor.setFontSize("14px");
}

function setEditorTemplate(){
    if(isChangeTemplate == 1)return;
    var templateSource = sourceCodeEditorTemplate[selectLanguage];
    sourceCodeEditor.setValue(templateSource);
    sourceCodeEditor.clearSelection();
}

var loadSourceCodeFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        $.get(reader.result, function(data) {
            sourceCodeEditor.setValue(data);
            sourceCodeEditor.clearSelection();
            changeTemplate(); 
        }, "text");
        
    };
    if(event.target.files[0]){
      reader.readAsDataURL(event.target.files[0]);
    }
};

$('#openFile').click(function(){ 
    $('#sourceCode').trigger('click');
});

function downloadEditorSourceCode(){
    download(sourceCodeEditor.getValue(), fileNames[selectLanguage], "text/plain");
}

function setEditorSelectLanguage(){
    if (selectLanguage.startsWith("cpp")) {
        sourceCodeEditor.getSession().setMode("ace/mode/c_cpp");
    }
    else if (selectLanguage.startsWith("c")) {
        sourceCodeEditor.getSession().setMode("ace/mode/c_cpp");
    }
    else if (selectLanguage.startsWith("java")) {
       sourceCodeEditor.getSession().setMode("ace/mode/java");
    }
    else if (selectLanguage.startsWith("py")) {
        sourceCodeEditor.getSession().setMode("ace/mode/python");
    }
    else if (selectLanguage.startsWith("rust")) {
        sourceCodeEditor.getSession().setMode("ace/mode/rust");
    }
    else if (selectLanguage.startsWith("d")) {
        sourceCodeEditor.getSession().setMode("ace/mode/d");
    }
}

function setSourceCodeEditorTemplate(){

}

function defineSourceCodeEditorTemplate(){
    sourceCodeEditorTemplate = {};
    
    sourceCodeEditorTemplate["c"]="\
#include <stdio.h>\n\
\n\
int main(void) {\n\
    printf(\"hello, world\\n\");\n\
    return 0;\n\
}\n\n";

    sourceCodeEditorTemplate["cpp"]="\
#include <iostream>\n\
\n\
int main() {\n\
    std::cout << \"hello, world\" << std::endl;\n\
    return 0;\n\
}\n\n";

sourceCodeEditorTemplate["java"]="\
import static org.junit.jupiter.api.Assertions.assertEquals;\n\
\n\
import org.junit.jupiter.api.Test;\n\
\n\
class MainTest {\n\
    static class Calculator {\n\
        public int add(int x, int y) {\n\
            return x + y;\n\
        }\n\
    }\n\
\n\
    private final Calculator calculator = new Calculator();\n\
\n\
    @Test\n\
    void addition() {\n\
        assertEquals(2, calculator.add(1, 1));\n\
    }\n\
}\n\n";
}


var fileNames = {
    c : "main.c",
    cpp : "main.cpp",
    java : "main.java",
    py : "main.c"
};