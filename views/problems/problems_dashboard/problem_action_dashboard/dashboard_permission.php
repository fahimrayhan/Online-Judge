
<style type="text/css">
	.pendingTxt,.notPermit{
		text-align: center;
		font-size: 25px;
		padding: 10px;
		font-weight: bold;
	}
	.pendingTxt i{
		font-size: 6em;
		color: #2ecc71;
	}

	.pendingTxt{
		color: #27ae60;
	}
	.notPermit{
		color: #c0392b;
	}
	.notPermiti{
		font-size: 6em;
		color: #e74c3c;
	}
</style>

<?php if($DB->userRole==40){ ?>
<div class="notPermit boxBody">
	<i class="fa fa-times notPermiti"></i><br/>
	You Can Not Permit This Page.If You Want To Problem Setter Please Send Request.<br/>
	<button id="sendReqBtn" onclick='sendProblemSetterRequest()'>Send Request</button>
</div>
<script type="text/javascript">
	function sendProblemSetterRequest(){
		btnOff("sendReqBtn","Sending");
		$.post("problem_dashboard_action.php",buildData("sendProblemSetterRequest"),function(response){
			//console.log(response);
			location.reload();
		});
	}
</script>
<?php } else{ ?>
<div class="pendingTxt boxBody">
	<i class="fa fa-clock-o "></i><br/>
	Your Request is Processiong.Please Waiting for Admin Response.
</div>
<?php } ?>
