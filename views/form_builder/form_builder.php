
<?php 
    if(isset($_GET['formHashId'])){
        $formHashId = $_GET['formHashId'];
        $formId = $Form->getFormIdFromHashId($formHashId);
    }

    $formPage = $formId == -1 ? "404.php":"views/form_builder/form_body.php";
    echo "<div id ='formBuilder'>";
    include "$formPage";
    echo "</div>";
?>

