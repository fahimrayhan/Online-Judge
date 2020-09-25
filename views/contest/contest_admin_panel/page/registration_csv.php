

<?php

$contestData = $Contest->getContestRegistrationData($contestId);
$displayNameList = $Contest->getContestDisplayNameList($contestId);

$keyList     = $Contest->getRegistrationOptionList($contestId);


foreach ($filterKeyList as $key => $value) {
    if (isset($keyList[$key])) {
        $filterKeyList[$key] = $keyList[$key];
    }
}

$hashString = $SiteHash->getRandomString(10);
$fileName   = "temp/registration_list_$contestId_$hashString.csv";

exec("chmod -R 777 $fileName");

$handle = fopen($fileName, 'w');
ob_clean(); // clean slate

fputcsv($handle, $filterKeyList);
foreach ($contestData as $key => $value) {
    $tmpData = array();
    foreach ($filterKeyList as $key1 => $value1) {
        array_push($tmpData, $value[$key1]);
    }
    fputcsv($handle, $tmpData);
}

echo json_encode([
    'error'            => 0,
    'downloadFileName' => $fileName,
]);

ob_flush(); // dump buffer
fclose($handle);

?>