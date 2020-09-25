<div class="row">
	<div class="col-md-12">
		<div class="pull-right" style="margin-bottom: 20px;">
      <button class="btn btn-success" onclick="updateParticipantRegistration('Accepted')"><i class="fa fa-check"></i> Accepted</button>
      <button class="btn btn-warning" onclick="updateParticipantRegistration('Pending')"><i class="fa fa-clock-o"></i> Pending</button>
      <button class="btn btn-danger"  onclick="deleteParticipantRegistration()"><i class="fas fa-trash"></i> Delete</button>
      <button class="btn btn-info" onclick="downloadRegistrationList()"><i class="fa fa-download"></i> Download</button>
		</div>
	</div>
</div>

<style type="text/css">
	td{
		text-align: center;
	}
</style>

<?php 
	include "style/lib/datatable/datatable_lib.php";
	$formKeyList = $Contest->getRegistrationOptionList($contestId);
?>
<script type="text/javascript">

	$(document).ready(function() {
    registrationTable = $('#registrationTable').DataTable({
      	'processing': true,
      	'responsive': true,
      	'serverSide': true,
      	'serverMethod': 'post',
      	'scrollX': true,
        "order": [[ 1, "desc" ]],
      	
      	'ajax': {
          	'url':'contest_dashboard_action.php',
          	'data': {
           		'contestId': 4,
           		'contestRegistrationList': 1
          	 // etc..
        	}
      	},
      	'columns': [
      	<?php
      		foreach ($formKeyList as $key => $value) {
      			$orderable = ($key=="action")?",'orderable':false":"";
            echo "{data: '$key'$orderable},";
      		}
      	 ?>
      ]
   });
    
} );
  function checkAllRegistrationList(e){
    $("input[name='contestRegistrationList[]']").attr('checked', e.checked);
  }

</script>

<table id="registrationTable" style="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<?php
        $formKeyList['action'] = "<input type='checkbox' onchange='checkAllRegistrationList(this)'>";
      	foreach ($formKeyList as $key => $value) {
      ?>
			<td class="contestTd1"><?php echo $value; ?></td>
		<?php } ?>
		</tr>
	</thead>
</table>

