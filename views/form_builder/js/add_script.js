var optionList = {};
var countOption = 0;

function selectInputType(e) {
    $("#formEditorOptionBody").html("");
    $("#formEditorOptionBody").hide();
    setField(e.value);
    $("#formOptionSettingBody").show();
    $("#formEditorOptionBody").show(500);
    $(function() {
        $('#disabled').bootstrapToggle();
        $('#required').bootstrapToggle();
    })
}

function setField(type) {
    previewOption(type);
    var formListData = formFieldListKey[type];
    $.each(formListData, function(key, value) {
        appendField(addInputTypeField(value));
    });

    if(type == "select"){
        addSelectField();
    }
}

function addSelectField(){
	$("#formEditorOptionBody").append("<button style='margin-top: 15px;' type='button' onclick='addOptionList()' class='btn-success' title='Add Option'><i class='fa fa-plus'></i> Ad Option</button>");
}


function appendField(data) {
    $("#formEditorOptionBody").append(makeField(data));
}

function makeField(data) {
    return "<tr><td class='ftd1'>" + data['fieldTitle'] + "</td><td class='ftd2'>" + data.fieldHtml + "</td></tr>";
}

function addInputTypeField(type) {
    fieldInputData = fieldInfoKey[type];
    var fieldTitle = fieldInputData.fieldTitle;
    if (fieldInputData.fieldType == "input") {
        fieldHtml = addInputBox(fieldInputData.fieldParameter);
    } else if (fieldInputData.fieldType == "bool") {
        fieldHtml = addToogleField(fieldInputData.fieldParameter);
    }
    return {
        fieldTitle,
        fieldHtml
    };
}

function addToogleField(data) {
    return "<input type='checkbox' id='" + data.name + "' name='" + data.name + "' value='true' onchange ='changeVal(this)' data-toggle='toggle' data-on='" + data.on + "' data-off='" + data.off + "' data-style='ios'>";
}

function addInputBox(data) {
    return "<input onkeyup='changeVal(this)' id='"+data.id+"' type='" + data.type + "' name='" + data.name + "'  value='" + data.value + "'placeholder='" + data.placeholder + "' autocomplete='off'>";
}

function changeVal(e) {
    console.log(e);
    if (e.name == "value") $("#previewInput").val(e.value);
    else if (e.name == "disabled" || e.name == "required") {
        $('#previewInput').prop(e.name, $('input[name=' + e.name + ']').is(':checked'));
    } 
    else if(e.name == "optionValue" || e.name == "optionText"){
        if(e.name == "optionValue")optionList[e.id].value = e.value;
        else if(e.name == "optionText")optionList[e.id].text = e.value;
    	buildSelectOption();
    }
    else {
    	var rmAttr = e.name == "pattern" && e.value == "";
    	if(rmAttr) $("#previewInput").removeAttr( e.name );
    	else $("#previewInput").attr(e.name, e.value);
    } 

}

function changeOptionGlobal(e){
	if(e.name == "title"){
		$("#previewTitle").html(e.value);
	}
	else if(e.name == "description"){
		$("#previewDescription").html(e.value);
	}

}

function deleteOption(e){
    $( "#optionArea_"+e.value ).remove(); 
    delete optionList[e.value];

    buildSelectOption();
}

function addOptionList(){

	countOption++;

    optionId = "option_"+countOption;

     optionValue = "Option "+countOption;

    optionList[optionId] = {value: optionValue,text: optionValue};

    var optionHtml = "<div id ='optionArea_"+optionId+"'>";
    optionHtml += "<input style='margin-right:5px;width:43%!important' type='text' name='optionValue' id='"+optionId+"' onkeyup='changeVal(this)'  value='"+optionValue+"' placeholder='Option Value' autocomplete='off'>";
    optionHtml += "<input style='margin-right:5px;width:43%!important' type='text' name='optionText' id='"+optionId+"' onkeyup='changeVal(this)'  value='"+optionValue+"' placeholder='Option Text' autocomplete='off'>";
    optionHtml += "<button type='button' title='Delete This Option' onclick = 'deleteOption(this)' value ='"+optionId+"' class='btn-sm btn-danger'><i class='fa fa-trash-o'></i></button>"
	optionHtml +="</div>";

    $("#formEditorOptionBody").append(optionHtml);
	buildSelectOption();

}

function buildSelectOption(){
    $('#previewInput').empty();
    $.each(optionList, function(key, value) { 
        //console.log(value);
        $('#previewInput').append($("<option></option>").attr("value", value.key).text(value.text)); 
    });
}

function previewOption(type) {
    htmlVal = "";
    if (type == "textarea") {
        htmlVal = "<textarea id='previewInput'></textarea>";
    } else if (type == "text" || type == "number" || type == "range" || type == "month") {
        htmlVal = "<input type ='" + type + "' id='previewInput'>";
    }
    else if(type == "select"){
    	htmlVal = "<select id='previewInput'></select>";
    }
    $("#previewArea").html(htmlVal);

}

function addFormOption() {
    var data = $("#previewArea");
    console.log(data);
}
var fieldInfo = {
    placeholder: {
        fieldTitle: "placeholder",
        fieldType: "input",
        fieldParameter: {
            type: 'text',
            name: 'placeholder',
            value: '',
            name: 'placeholder',
            placeholder: 'placeholder'
        }
    },
    value: {
        fieldTitle: "value",
        fieldType: "input",
        fieldParameter: {
            type: 'text',
            name: 'value',
            value: '',
            placeholder: 'value'
        }
    },
    valueNumber: {
        fieldTitle: "value",
        fieldType: "input",
        fieldParameter: {
            type: 'number',
            name: 'value',
            value: '',
            placeholder: 'value'
        }
    },
    maxlength: {
        fieldTitle: "maxlength",
        fieldType: "input",
        fieldParameter: {
            type: 'number',
            name: 'maxlength',
            value: '',
            placeholder: 'maxlength'
        }
    },
    max: {
        fieldTitle: "max",
        fieldType: "input",
        fieldParameter: {
            type: 'number',
            name: 'max',
            value: '',
            placeholder: "max"
        }
    },
    min: {
        fieldTitle: "min",
        fieldType: "input",
        fieldParameter: {
            type: 'number',
            name: 'min',
            value: '',
            placeholder: "min"
        }
    },
    step: {
        fieldTitle: "step",
        fieldType: "input",
        fieldParameter: {
            type: 'number',
            name: 'step',
            value: '',
            placeholder: "step"
        }
    },
    pattern: {
        fieldTitle: "pattern",
        fieldType: "input",
        fieldParameter: {
            type: 'pattern',
            name: 'pattern',
            value: '',
            placeholder: "pattern"
        }
    },
    disabled: {
        fieldTitle: "disabled",
        fieldType: "bool",
        fieldParameter: {
            name: 'disabled',
            on: 'On',
            off: 'Off'
        }
    },
    required: {
        fieldTitle: "required",
        fieldType: "bool",
        fieldParameter: {
            name: 'required',
            on: 'On',
            off: 'Off'
        }
    },
}
var formFieldList = {
    textarea: ['value', 'placeholder', 'maxlength','disabled', 'required'],
    text: ['placeholder', 'value', 'maxlength','pattern','required'],
    number: ['max', 'min', 'step', 'value', 'placeholder','required'],
    range: ['max', 'min', 'step', 'valueNumber', 'disabled','required'],
    month: ['placeholder','required'],
    select: ['required'],
}
var fieldInfoKey = jQuery.makeArray(fieldInfo);
fieldInfoKey = fieldInfoKey[0];
var formFieldListKey = jQuery.makeArray(formFieldList);
formFieldListKey = formFieldListKey[0];