<?php

class FormBuilder
{

    private $inputList     = array();
    private $processField  = array();
    private $inputDefaults = array(
        'type'        => 'text',
        'name'        => '',
        'id'          => '',
        'value'       => '',
        'placeholder' => '',
        'min'         => '',
        'max'         => '',
        'step'        => '',
        'size'        => '',
        'maxlength'   => '',
        'minlength'   => '',
        'pattern'     => '',
        'autofocus'   => false,
        'checked'     => false,
        'selected'    => false,
        'required'    => false,
        'disabled'    => false,
        'readonly'    => false,
        'options'     => array(),
        'selectedOptions'     => array()

    );
    private $binaryField = array('autofocus', 'checked', 'required', 'disabled', 'readonly');
    private $textField   = array(
        'name', 'type', 'id', 'value', 'placeholder',
        'min', 'max', 'step', 'pattern', 'maxlength', 'minlength', 'size',
    );
    private $arrayField = array('options','selectedOptions');

    private $formInputData = array();
    private $inputValue    = array();

    public function addInput($args = '')
    {
        if (empty($args)) {
            $args = array();
        }

        array_push($this->inputList, $args);
    }

    public function buildInputList()
    {

        foreach ($this->inputList as $key => $value) {

            $this->buildField($value);
        }
    }

    public function buildField($formInputData = '')
    {

        if (empty($formInputData)) {
            $formInputData = array();
        }

        $this->formInputData = array_merge($this->inputDefaults, $formInputData);
        $this->processInputValue();

        switch ($this->formInputData['type']) {
            case 'textarea':
                $this->buildTextArea();
                break;
            case 'select':
                $this->buildSelectField();
                break;
            case 'radio':
            case 'checkbox':
                $this->buildCheckedField();
                break;
            default:
                $this->buildInputField();
                break;
        }

    }

    public function processInputValue()
    {

        $val      = $this->formInputData;
        $formType = $val['type'];

        foreach ($this->textField as $key => $value) {
            $this->inputValue[$value] = !empty($val[$value]) ? "$value ='" . $val[$value] . "'" : "";
        }

        foreach ($this->binaryField as $key => $value) {
            $this->inputValue[$value] = $val[$value] ? "$value" : "";
        }

        foreach ($this->arrayField as $key => $value) {
            $this->inputValue[$value] = empty($value) ? array() : $value;
        }

        if (!($formType == 'range' || $formType == 'number')) {
            $this->inputValue['min']  = '';
            $this->inputValue['max']  = '';
            $this->inputValue['step'] = '';
        }
    }

    public function getFieldOption($fieldList = '')
    {
        if ($fieldList == '') {
            $fieldList = array();
        }

        $field = "";
        foreach ($this->inputValue as $key => $value) {
            if (in_array($key, $fieldList)) {
                $field .= $value . " ";
            }

        }
        return $field;
    }

    public function buildTextArea()
    {
        $textAreaFieldList = array(
            'name', 'id', 'placeholder', 'maxlength', 'required', 'disabled', 'readonly',
        );

        $field = $this->getFieldOption($textAreaFieldList);
        $value = isset($this->formInputData['value']) ? $this->formInputData['value'] : "";
        $field = "<textarea $field>$value</textarea>";

        echo "$field";
    }

    public function buildInputField()
    {
        $textAreaFieldList = array(
            'type', 'name', 'id', 'value', 'placeholder',
            'min', 'max', 'step', 'pattern', 'maxlength', 'minlength', 'size',
            'required','disabled', 'readonly'
        );

        $field = $this->getFieldOption($textAreaFieldList);
        $field = "<input $field >";

        echo "$field";
    }

    public function buildSelectField()
    {
    	$textAreaFieldList = array(
            'name', 'id', 'required', 'disabled',
        );

        $field = $this->getFieldOption($textAreaFieldList);
        $options = "";
       
        foreach ($this->formInputData['options'] as $key => $value) {
        	$selected = (in_array($key, $this->formInputData['selectedOptions']))?"selected":"";
        	$options.="<option value ='$key' $selected>$value</option>";
        }
        $field = "<select $field >$options</select>";

        echo "$field";
    }

    public function buildCheckedField(){
    	
  		$inputType = $this->formInputData['type'];
  		$name = $this->formInputData['name'];
  		
  		$options = "";
  		$cnt = 1;
  		foreach ($this->formInputData['options'] as $key => $value) {
        	$selected = (in_array($key, $this->formInputData['selectedOptions']))?"checked":"";
        	if($cnt++ == 1 && $inputType == "radio"){
        		$selected = "checked";
        	}
        	$options .= "<input type='$inputType' name='$name".'[]'."' value='$key' $selected>";
        	$options .= "<label> $value</label><br/>";
        }
        echo "$options";
    }

}
