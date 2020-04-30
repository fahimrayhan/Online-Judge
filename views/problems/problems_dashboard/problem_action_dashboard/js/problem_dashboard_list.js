var dashboard_action_url="problem_dashboard_action.php";


function loadProblemAddPage(){
	modal_action("sm","Add Problem");
	loader("modal_sm_body");
	
	$.post(dashboard_action_url,buildData("loadProblemAddPage"),function(response){
		$("#modal_sm_body").html(response);
	});
}

function addProblem(){
	var data={
		'problemName': $("#problemName").val(),
		'cpuTimeLimit': $("#problemTimeLimit").val(),
		'memoryLimit': $("#problemMemoryLimit").val()
	}

	btnOff("addProblem","Saving");
	$("#error_area").hide();

	$.post(dashboard_action_url,buildData("addProblem",data),function(response){
		console.log(response);
		response=JSON.parse(response); 
		if(response.error==1){
			$('#error_area').removeClass('label-success').addClass('label-danger');
			$("#error_area").show();
			$("#error_area").html(response.msg);
			btnOn("addProblem","Add Problem");
		}
		else{
			window.location.href ="problems_dashboard.php?id="+response.insert_id+"&action=overview";
		}
	});
}


function deleteProblem(problemId){
  var ok=confirm('Are You Want To Delete This Test Case.');
  if(!ok)return;
  loader("modal_lg_body");
  $.post(dashboard_action_url, buildData("deleteProblem", problemId), function (response) {
    
    response=JSON.parse(response); 
	if(response.error==1){
		toast.danger("You Can Not Delete This Problem.");
	}
	else
		location.reload();
  });
}