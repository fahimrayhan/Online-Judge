<script type="text/javascript">currentOrder = [];</script>
<?php
    foreach ($contestSignUpForm as $key => $value) {
            echo "<script>currentOrder.push('".$value['contestRegistrationFormId']."');</script>";
    }
?>
<ul id="list">
    <?php
$contestSignUpForm = $Contest->getContestSignUpFormList(3);
foreach ($contestSignUpForm as $key => $value) {?>
        <li><?php echo $value['formOptionTitle']; ?></li>
    <?php }?>
</ul>

