<?php 

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="filename.csv"');
echo "hello"; exit();
?>