<div class="row">
<div class="col-md-12">
<div style="padding: 15px;text-align: center;">
  <form enctype="multipart/form-data" action="" method="post" id="uploadCSV">
    <table>
        <tr>
            <td class="width"></td>
            <td><input type="hidden" name="MAX_FILE_SIZE" value="10000000" /><input type="file" name="csvfile" id="csvfile" value=""/></td>
            <td><input type="submit" name="uploadCSV" value="Upload" /></td>
        </tr>
    </table>
</form>
</div>
<?php 
  if(isset($_POST['uploadCSV'])){
    
    $fileType = strtolower($_FILES['csvfile']['type']);
    
    $ok = 0;

    if (strpos($fileType, 'csv') !== false) $ok = 1;

    if($ok == 0){
      echo "You can not upload csv file";
      return;
    }

    $csvfile = $_FILES['csvfile']['tmp_name'];
    $csv = $File->getCsvToArray($csvfile);
    echo "<script>generateUserList = '".json_encode($csv['data'])."'</script>";
?>

<!--Table-->

  <div class="row">
    <div class="col-md-3 col-sm-12">
      <input type="" class='form-control' id="userPrefix" name="" placeholder="Prefix User">
    </div>
    <div class="col-md-3 col-sm-12">
      <input type="" class='form-control' id="userPasswordLength" placeholder="Password Length">
    </div>
    <div class="col-md-3 col-sm-12">
      <button class="contestDashboardBtn" onclick="generateUser()">+ Create Users</button>
    </div>
    <div class="col-md-3 col-sm-12">
      <button class="contestDashboardBtn" onclick="generateUser()">+ Upload CSV</button>
    </div>
  </div>

<div id="genResponse"></div>
<table id="tablePreview" class="table table-hover table-sm table-bordered">
    <thead>
    <tr>
        <?php foreach ($csv['dataKey'] as $key => $value) {
          echo "<th class='td1'>".$value."</th>"; 
        } ?>
    </tr>
    </thead>
    <tbody>
    <?php 
       foreach ($csv['data'] as $key => $value) {
            echo "<tr>";
            foreach ($value as $key1 => $value1) {
                echo "<td class='td2'>".$value1."</td>"; 
            }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
<?php } ?>
</div>
</div>