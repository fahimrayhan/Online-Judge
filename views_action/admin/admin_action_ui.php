<?php
	
	if(isset($_POST['adminDashboard'])){
		$info=$User->getPageViewList();
		$colorList=array();
		array_push($colorList, "#8e44ad");
		array_push($colorList, "#2980b9");
		array_push($colorList, "#27ae60");
		array_push($colorList, "#16a085");
		array_push($colorList, "#c0392b");
		array_push($colorList, "#d35400");
		array_push($colorList, "#f39c12");
		echo '<table id="datatable" class="table table-striped table-bordered" style="border: 1px solid #DDDDDD" cellspacing="0" width="100%">
    				<thead>
						<tr>
							<th class="td_list1" style="text-align:center"><b>#ID</b></th>
							<th class="td_list1">
								<div class="pull-left">userIp</div>
							</th>
							<th class="td_list1"><b>userBrowserName</b></th>
							<th class="td_list1"><b>userBrowserVersion</b></th>
							<th class="td_list1"><b>userPlatform</b></th>
							<th class="td_list1"><b>visitPageUrl</b></th>
							<th class="td_list1"><b>visitTime</b></th>
                        </tr>
					</thead><tbody>';
		foreach ($info as $key => $value) {
			$mod=$value['pageViewId']%7;
			$color=$colorList[$mod];
			echo '<tr style="background-color: '.$color.'">
							<td class="td_list2" style="text-align: center">
								'.$value['userId'].'
							</td>
							<td class="td_list2" style="text-align: left;">
								'.$value['userIp'].'
							</td>
							<td class="td_list2" style="text-align: left;">
								'.$value['userBrowserName'].'
							</td>
							<td class="td_list2" style="text-align: left;">
								'.$value['userBrowserVersion'].'
							</td>
							<td class="td_list2" style="text-align: left;">
								'.$value['userPlatform'].'
							</td>
							<td class="td_list2" style="text-align: left;">
								'.$value['visitPageUrl'].'
							</td>
							<td class="td_list2" style="text-align: left;">
								'.$value['visitTime'].'
							</td>
							
						</tr>';
		}
		echo "</tbody></table>";
	}

	if(isset($_POST['judgeProblemList'])){
		$status=$_POST['judgeProblemList'];
		$status=$status!=-1?"status=$status":"";
		$problemList=$Problem->getAllJudgeProblemList($status);
		$u_agent = $User->getBrowser();
		echo '<table id="datatable" class="table table-striped table-bordered" style="border: 1px solid #DDDDDD" cellspacing="0" width="100%">
    				<thead>
						<tr>
							<th class="td_list1" style="text-align:center"><b>#ID</b></th>
							<th class="td_list1">
								<div class="pull-left">Problem Name</div>
							</th>
							<th class="td_list1"><b>Added Date</b></th>
							<th class="td_list1"><b>Action</b></th>
                        </tr>
					</thead><tbody>';
		foreach ($problemList as $key => $value) {
			$listId=$value['judgeProblemListId'];
			$status=$value['status'];
			$problemId=$value['problemId'];
			$problemName=$value['problemName'];
			$addedDate=$DB->dateToString($value['addedDate']);
			$activeBtn=$status==0?'<button onclick="addJudgeProblemList('.$listId.')" class="btn-sm btn-success"><i class="fas fa-check"></i> Approved</button>':'';
			$deleteTxt=$status==0?'Cancel':"Delete";
			echo '<tr>
							<td class="td_list2" style="width: 8%; text-align: center"><a target="_blank" href="problems_dashboard.php?id='.$problemId.'&action=viewProblem">'.$problemId.'</a></td>
							<td class="td_list2" style="width: 50%;text-align: left;padding-left: 10px!important">
								<div class="pull-left"><a target="_blank" href="problems_dashboard.php?id='.$problemId.'&action=viewProblem">'.$problemName.'</a>
								</div>
							</td>

							<td class="td_list2" style="width: 20%;">
								'.$addedDate.'</span>
							</td>

							<td class="td_list2" style="width: 22%;">
								<button onclick="delJudgeProblemList('.$problemId.')" class="btn-sm btn-danger"><i class="fas fa-trash"></i> '.$deleteTxt.'</button>
								'.$activeBtn.'
							</td>
							
						</tr>';
		}
		echo "</tbody></table>";

	}

	if(isset($_POST['judgePendingProblemList'])){
		
	}

?>