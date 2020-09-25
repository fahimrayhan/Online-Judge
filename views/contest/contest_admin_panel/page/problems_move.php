

<?php

$contestData = $Contest->getContestRegistrationData($contestId);
$keyList     = $Contest->getRegistrationOptionList($contestId);
unset($keyList['action']);
header('Content-Description: File Transfer');
header('Content-Type: application/csv');
header("Content-Disposition: attachment; filename=registration_list.csv");
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

$handle = fopen('php://output', 'w');
ob_clean(); // clean slate

fputcsv($handle, $keyList);
foreach ($contestData as $key => $value) {
    $tmpData = array();
    foreach ($keyList as $key1 => $value1) {
        array_push($tmpData, $value[$key1]);
    }
    fputcsv($handle, $tmpData);
}

ob_flush(); // dump buffer
fclose($handle);
die();
?>