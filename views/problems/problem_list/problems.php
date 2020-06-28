<title>Problems | CoderOJ</title>
<?php include "style/lib/data_table/data_table_lib.php"; ?>

<script type="text/javascript">
	$(document).ready(function() {
    $('#datatable').dataTable();
    
     $("[data-toggle=tooltip]").tooltip();
    
} );

</script>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box_header">
				<span class="glyphicon glyphicon-list-alt"></span> Problems<?php if($DB->isLoggedIn>0){ ?> <a href="problems_dashboard.php"><button>Problem Dashboard</button></a> <?php } ?> </div>
			<div class="box_body">
				<?php include "views/problems/problem_list/problem_list.php"; ?>
			</div>
		</div>
		
	</div>

</div>
