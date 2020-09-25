<?php

function globalStructure($label, $body)
{
    $labelName  = isset($label['name']) ? $label['name'] : "";
    $labelHints = isset($label['hint']) ? "<small class='form-text text-muted'>".$label['hint']."</small><br/>" : "";
    $labelExtra = isset($label['extra']) ? $label['extra']: "";
    $ret        = "<div class='form-group'><label class='control-label col-sm-3' for=' $labelName '>$labelName:</label><div class='col-sm-9'>$body $labelHints $labelExtra</div></div>";

    return $ret;
}

function addInput($data)
{
    $input = "<input class = 'form-control' ";
    foreach ($data['option'] as $key => $value) {
        $input .= $key . "=" . "'$value' ";
    }
    $input .= ">";
    return globalStructure($data['label'], $input);
}

function addTextArea($data)
{
    $textArea = "<textarea class = 'form-control' ";
    foreach ($data['option'] as $key => $value) {
        $textArea .= $key . "=" . "'$value' ";
    }
    $textArea .= ">";
    $textArea .= $data['value'] . "</textarea>";
    return globalStructure($data['label'], $textArea);
}

function addCheckBox($data)
{
    $input = "<input type = 'checkbox' class = 'form-control' ";
    foreach ($data['option'] as $key => $value) {
        $input .= $key . "=" . "'$value' ";
    }
    if ($data['checked'] == 'true') {
        $input .= "checked";
    }

    $input .= ">";
    return globalStructure($data['label'], $input);
}

function addSelectOption($data)
{
    $selectedOption = isset($data['optionSelected']) ? $data['optionSelected'] : "";


    $select = "<select class='form-control' ";
    foreach ($data['option'] as $key => $value) {
        $select .= $key . "=" . "'$value'";
    }
    $select .= ">";

    $option = "";
    foreach ($data['optionList'] as $key => $value) {
        $selected = $selectedOption == $key ? "selected" : "";
        $option .= "<option value ='$key' $selected>$value</option>";
    }
    $select .= $option . "</select>";
    return globalStructure($data['label'], $select);
}

function addFormField($data)
{
    if ($data['type'] == "input") {
        return addInput($data);
    } else if ($data['type'] == "select") {
        return addSelectOption($data);
    } else if ($data['type'] == "textarea") {
        return addTextArea($data);
    } else if ($data['type'] == 'checkbox') {
        return addCheckBox($data);
    }

}

function setGroup($data)
{
    global $form;
    $formData = $form;
    $group    = "<fieldset><legend><center>" . $data['groupName'] . "</center></legend>";
    foreach ($data['formList'] as $key => $value) {
        $group .= addFormField($formData[$value]);
    }
    $group .= "</fieldset>";
    echo $group;
}

function buildForm($formGroupList)
{
    global $formGroup;
    foreach ($formGroupList as $key => $value) {
        setGroup($formGroup[$value]);
    }
}

$formGroup = array(
    'contestInfo'        => array(
        'groupName' => "Contest Info",
        'formList'  => array(
            'contestName', 'contestFormat', 'startTime', 'duration','contestPublish',
        ),
    ),
    'contestDescription' => array(
        'groupName' => "Contest Description",
        'formList'  => array(
            "contestBanner", "contestDescription",
        ),
    ),
);

$form = array(
    'contestName'         => array(
        'type'   => "input",
        'label'  => array(
            'name' => 'Contest Name',
        ),
        'option' => array(
            'name'        => 'contestName',
            'placeholder' => 'Contest Name',
            'required' => '',
            'value'       => $contestInfo['contestName'],
        ),
    ),
    'startTime'           => array(
        'type'   => "input",
        'label'  => array(
            'name' => 'Start Time',
        ),
        'option' => array(
            'type'        => 'datetime-local',
            'name'        => 'contestStart',
            'placeholder' => 'Start Time',
            'value'       => date('Y-m-d\TH:i', strtotime($contestInfo['contestStart'])),
        ),
    ),
    'duration'            => array(
        'type'   => "input",
        'label'  => array(
            'name' => 'Duration',
            'hint' => 'Contest duration in minutes',
        ),
        'option' => array(
            'type'        => 'number',
            'name'        => 'contestDuration',
            'placeholder' => 'Duration',
            'required' => '',
            'min' => 1,
            'value'       => $contestInfo['contestDuration'],
        ),
    ),
    'contestFormat'       => array(
        'type'           => "select",
        'label'          => array(
            'name' => "Contest Format",
        ),
        'option'         => array(
            'name' => "contestFormat",
        ),
        'optionList'     => array(
            'IOI'  => "IOI",
            "ICPC" => "ICPC",
        ),
        'optionSelected' => $contestInfo['contestFormat'],
    ),
    'contestPublish'     => array(
        'type'    => "checkbox",
        'label'   => array(
            'name' => 'Contest Publish',
        ),
        'option'  => array(
            'name'          => 'contestPublish',
            'value'         => 'true',
            'data-toggle'   => 'toggle',
            'data-on'       => 'Yes',
            'data-off'      => 'No',
            'data-style'    => 'ios',
            'data-onstyle'  => "success",
            'data-offstyle' => "danger",
            'data-width'    => "80",
        ),
        'checked' => $contestInfo['contestPublish'],

    ),
    'contestBanner'       => array(
        'type'   => "input",
        'label'  => array(
            'name'  => 'Contest Banner',
            'hint' => 'You can upload banner using CoderOJ <a href ="javascript:viewFileManager();">file manager</a>',
            'extra' => "<img id='contestBannerPreview' src='" . $contestInfo['contestBanner'] . "' style = 'height: 150px;margin-top: 10px' class='img-thumbnail' />",
        ),
        'option' => array(
            'name'        => 'contestBanner',
            'placeholder' => 'Contest Banner',
            'value'       => $contestInfo['contestBanner'],
            'onkeyup'     => "contestBannerImgPreview(this)",
        ),
    ),
    'contestDescription'  => array(
        'type'   => "textarea",
        'label'  => array(
            'name' => 'Contest Description',
        ),
        'option' => array(
            'name'        => 'contestDescription',
            'placeholder' => 'Contest Description',
            'id'          => 'contestDescription',
        ),
        'value'  => $contestInfo['contestDescription'],
    ),
    'contestFreezePeriod' => array(
        'type'   => "input",
        'label'  => array(
            'name' => 'Freeze Period',
            'hint' => 'Standings freeze period in minutes',
        ),
        'option' => array(
            'type'        => 'number',
            'name'        => 'contestFreezePeriod',
            'placeholder' => 'Freeze Period',
            'required' => '',
            'min' => 0,
            'value'       => $contestInfo['contestFreezePeriod'],
        ),
    ),
    'contestFreeze'       => array(
        'type'    => "checkbox",
        'label'   => array(
            'name' => 'Contest Frozen',
        ),
        'option'  => array(
            'name'          => 'contestFreeze',
            'value'         => 'true',
            'data-toggle'   => 'toggle',
            'data-on'       => 'Yes',
            'data-off'      => 'No',
            'data-style'    => 'ios',
            'data-onstyle'  => "success",
            'data-offstyle' => "danger",
            'data-width'    => "80",
            'onchange'      => "checkContestFreeze(this)",
        ),
        'checked' => $contestInfo['contestFreeze'],

    ),
    'contestUnFreeze'     => array(
        'type'    => "checkbox",
        'label'   => array(
            'name' => 'Contest UnFrozen',
        ),
        'option'  => array(
            'name'          => 'contestUnFreeze',
            'value'         => 'true',
            'data-toggle'   => 'toggle',
            'data-on'       => 'Yes',
            'data-off'      => 'No',
            'data-style'    => 'ios',
            'data-onstyle'  => "success",
            'data-offstyle' => "danger",
            'data-width'    => "80",
        ),
        'checked' => $contestInfo['contestUnFreeze'],

    ),
    'registrationClose'   => array(
        'type'   => "input",
        'label'  => array(
            'name' => 'Registration Close',
            'hint' => 'After this time user can not registration this contest.',
        ),
        'option' => array(
            'type'        => 'datetime-local',
            'name'        => 'registrationClose',
            'placeholder' => 'Registration Close',
            'value'       => date('Y-m-d\TH:i', strtotime($contestInfo['registrationClose'])),
        ),
    ),
    'contestVisibility'   => array(
        'type'           => "select",
        'label'          => array(
            'name' => "Contest Visibility",
        ),
        'option'         => array(
            'name' => "contestVisibility",
            'onchange' => "selectContestVisibility(this)",
        ),
        'optionList'     => array(
            'Public'    => "Public - any one can registration and participate",
            "Protected" => "Protected - any one can registration and participate but before registration need password",
            "Private"   => "Private - only invited user can participate",
        ),
        'optionSelected' => $contestInfo['contestVisibility'],
    ),
    'contestPassword'     => array(
        'type'   => "input",
        'label'  => array(
            'name' => 'Contest Password',
            'hint' => 'User need this password before registration',
        ),
        'option' => array(
            'name'        => 'contestPassword',
            'placeholder' => 'Contest Password',
            'value'       => $contestInfo['contestPassword'],
        ),
    ),
    'registrationAutoAccept'     => array(
        'type'    => "checkbox",
        'label'   => array(
            'name' => 'Registration Auto Accept',
        ),
        'option'  => array(
            'name'          => 'registrationAutoAccept',
            'value'         => 'true',
            'data-toggle'   => 'toggle',
            'data-on'       => 'Yes',
            'data-off'      => 'No',
            'data-style'    => 'ios',
            'data-onstyle'  => "success",
            'data-offstyle' => "danger",
            'data-width'    => "80",
        ),
        'checked' => $contestInfo['registrationAutoAccept'],

    ),
);
