
var url="submission_action.php";
function load_submit_problem_page(){
	modalOpen("md","Submit Solution");
	loader("modal_md_body");
	$.post(url,buildData("load_submit_problem_page"),function(response){
		$("#modal_md_body").html(response);
	});
}