<script type="text/javascript" src="views/problems/problems_dashboard/problem_action_dashboard/js/problem_dashboard_list.js"></script>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box_header">
				<span class="glyphicon glyphicon-list-alt"></span> Problems Dashboard <button id="addProblemBtn" onclick="loadProblemAddPage()">Add Problem</button> </div>
			<div class="box_body">
				<table id="datatable" class="table table-striped table-bordered" style="border: 1px solid #DDDDDD" cellspacing="0" width="100%">
    				<thead>
						<tr>
							<th class="td_list1"><b>#ID</b></th>
							<th class="td_list1">
								<div class="pull-left">Contest Name</div>
							</th>
							<th class="td_list1"><b>Contest Start</b></th>
							<th class="td_list1"><b>Contest Length</b></th>
							<th class="td_list1"><b>Contest Visivility</b></th>
							<th class="td_list1"><b>Contest Formate</b></th>
							<th class="td_list1"><b>Role</b></th>
							<th class="td_list1"><b>Action</b></th>
                        </tr>
					</thead>

					<tbody>
					<?php 
					$problemList=$Problem->getModeratorProblemList();
					//print_r($problemList);
					foreach ($problemList as $key => $value) {
						$problemId=$value['problemId'];
						$problemName=$value['problemName'];
						$role=$Problem->checkProblemModeratorRoles($problemId);
						$roleName=($role==1)?"Admin":"Moderator";
						$roleClass=($role==1)?"success":"info";

					?>			
						<tr>
							<td class="td_list2" style="width: 10%"><a href='problems_dashboard.php?id=<?php echo $problemId; ?>&action=viewProblem'><?php echo $problemId; ?></a></td>
							<td class="td_list2" style="width: 30%;text-align: left;padding-left: 10px!important">
								<div class="pull-left"><a href='problems_dashboard.php?id=<?php echo $problemId; ?>&action=viewProblem'><?php echo "$problemName"; ?></a>
								</div>
							</td>

							<td class="td_list2" style="width: 10%;">
								<span class="label label-<?php echo $roleClass; ?>"><?php echo $roleName; ?></span>
							</td>

							<td class="td_list2" style="width: 20%;">
								<button onclick="deleteProblem(<?php echo $problemId; ?>)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
								<a href="problems_dashboard.php?id=<?php echo $problemId; ?>&action=overview"><button class="btn-sm btn-primary"><i class="fas fa-pencil-square-o"></i></button></a>
							</td>
							
						</tr>
					<?php } ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.td_list1{
		text-align: center;
	}
	.td_list2{
		text-align: center;
	}
</style>