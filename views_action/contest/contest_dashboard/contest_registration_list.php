<?php

function ascSort($array, $key)
{
    usort($array, function ($a, $b) use ($key) {
        return strtolower($a[$key]) <=> strtolower($b[$key]);
    });
    return $array;
}

function descSort($array, $key)
{
    usort($array, function ($a, $b) use ($key) {
        return strtolower($b[$key]) <=> strtolower($a[$key]);
    });
    return $array;
}

function searchInfo($data, $searchValue)
{
    $ret         = array();
    $searchValue = strtolower($searchValue);
    if ($searchValue == "") {
        return $data;
    }

    foreach ($data as $key => $value) {
        $ok = 0;
        foreach ($value as $key1 => $value1) {
            $value1   = strtolower($value1);
            $position = strpos($value1, $searchValue);
            $ok |= is_numeric($position);
        }
        if ($ok) {
            array_push($ret, $value);
        }

    }
    return $ret;
}

$draw       = isset($_POST['draw']) ? $_POST['draw'] : 1;
$row        = isset($_POST['start']) ? $_POST['start'] : 1;
$rowperpage = isset($_POST['length']) ? $_POST['length'] : 1;

$columnIndex     = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 1;
$columnName      = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : "";
$columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : "";
$searchValue     = isset($_POST['search']['value']) ? $_POST['search']['value'] : "";

$contestId = 3;

$registrationList = $Contest->getContestRegistrationList(3);
$formKeyList = $Contest->getRegistrationOptionList(3);
$displayNameList = $Contest->getContestDisplayNameList($contestId);

$contestRegistrationData = array();

foreach ($registrationList as $key => $value) {
    $data = $value;
    unset($data['registrationInfo']);

    //basic Info
    $tmpData = json_decode($value['registrationInfo'], true);
    foreach ($tmpData as $key => $value) {
        if (!isset($formKeyList[$key])) {
            unset($tmpData[$key]);
        }
    }

    $data = array_merge($tmpData, $data);

    foreach ($data as $key => $value) {
        if (!isset($formKeyList[$key])) {
            unset($data[$key]);
        }
    }
    foreach ($formKeyList as $key => $value) {
        if (!isset($data[$key])) {
            $data[$key] = "";
        }
    }

    array_push($contestRegistrationData, $data);
}

if($columnName == "action"){
    $columnName = "contestRegistrationId";
    $columnSortOrder = "desc";
}


$contestRegistrationData = ($columnSortOrder == "asc") ? ascSort($contestRegistrationData, $columnName) : descSort($contestRegistrationData, $columnName);

$contestRegistrationData = searchInfo($contestRegistrationData, $searchValue);

$allData = array();

foreach ($contestRegistrationData as $key => $value) {
    $registrationId = $value['contestRegistrationId'];

    $registrationStatus = $value['registrationStatus'];

    $acceptedBtn = ($registrationStatus != "Accepted") ? '<button id=' . $registrationId . ' title="Accepted Request" onclick="acceptParticipantRegistration(this)" class="btn-success btn-sm"> <i class="fa fa-check"></i></button>' : "";

    if ($registrationStatus == "Pending") {
        $registrationStatus = "<span class='label label-warning'><i class='fa fa-clock-o'></i> $registrationStatus</span>";
    } else if ($registrationStatus == "Accepted") {
        $registrationStatus = "<span class='label label-success'><i class='fa fa-check'></i> $registrationStatus</span>";
    }


    $tmpData = $value;
    $tmpData['tempUser'] = $tmpData['tempUser'] == "Yes"?"<i class='fa fa-check'></i>":"";
    $tmpData['action'] =  '<input type="checkbox" name="contestRegistrationList[]" value='.$registrationId.'>';
    $tmpData['registrationStatus'] = $registrationStatus;
    $tmpData['displayName'] = $displayNameList[$registrationId]['displayName'];
    $tmpData['displaySubName'] = $displayNameList[$registrationId]['displaySubName'];
    $tmpData['registrationStatus'] = $registrationStatus;


    array_push($allData, $tmpData);
}

//$allData = $newData;

$data = array();

$iTotalRecords = count($allData);
$start         = $row;
$end           = min($iTotalRecords, $row + $rowperpage);

for ($i = $start; $i < $end; $i++) {
    array_push($data, $allData[$i]);
}

$response = array(
    "draw"                 => intval($draw),
    "iTotalRecords"        => $iTotalRecords,
    "iTotalDisplayRecords" => $iTotalRecords,
    "aaData"               => $data,
);

echo json_encode($response);
