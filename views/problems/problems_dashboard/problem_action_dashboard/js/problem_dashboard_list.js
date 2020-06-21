var dashboard_action_url="problem_dashboard_action.php";


function loadProblemAddPage(){
	modal.md.open("Add Problem");
	loader(modal.md.body);

	$.post(dashboard_action_url,buildData("loadProblemAddPage"),function(response){
		modal.md.setBody(response);
	});
}

function addProblem(){
	var data={
		'problemName': $("#problemName").val(),
		'cpuTimeLimit': $("#problemTimeLimit").val(),
		'memoryLimit': $("#problemMemoryLimit").val()
	}

	btnOff("addProblem","Saving");

	$.post(dashboard_action_url,buildData("addProblem",data),function(response){
		console.log(response);
		response=JSON.parse(response); 
		if(response.error==1){
			toast.danger(response.msg);
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