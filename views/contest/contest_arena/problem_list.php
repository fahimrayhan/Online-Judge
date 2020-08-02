<?php 
    $problemList = $Contest->getContestProblemList($contestId);
    foreach ($problemList as $key => $value) { 
        $problemNumber = $key;
?>
        <a href="contest_arena.php?id=<?php echo $contestId; ?>&problem=<?php echo $problemNumber; ?>" style="position: relative;" class="list-group-item problemListBox">
            <div style="margin-top: 9px;" class="pull-right"><i class="fa fa-user"></i> &times; 5</div>
            <div class="pull-left problemNo"><?php echo $problemNumber; ?></div>
            <h4 style="margin: 5px 0 4px; line-height: 30px;" class="list-group-item-heading"><?php echo $value['problemName']; ?></h4>
        </a>
<?php } ?>