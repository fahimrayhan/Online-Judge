<script src="http://mikeplate.github.io/jquery-drag-drop-plugin/jquery.drag-drop.plugin.js"></script>
<script type="text/javascript">currentOrder = [];</script>
<?php
    foreach ($contestSignUpForm as $key => $value) {
        echo "<script>currentOrder.push('".$value['contestRegistrationFormId']."');</script>";
    }
?>

<ul id="list" style="width: 100%">
    <?php
$contestSignUpForm = $Contest->getContestSignUpFormList(3);
foreach ($contestSignUpForm as $key => $value) {?>
        <li class="boxBody"><?php echo $value['formOptionTitle']; ?></li>
    <?php }?>
</ul>

