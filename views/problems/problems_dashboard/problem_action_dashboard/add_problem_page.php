<style type="text/css">
.inputLogin {
    padding: 12px 10px 12px 10px!important;
    width: 100%!important;
    border-radius: 5px!important;
    font-size: 14px!important;
    border: 1px solid #aaaaaa!important;
    margin-bottom: 7px!important;
    background-color: #ffffff!important;

}
.loginInputTitleTxt{
    font-weight: bold;
    padding-top: 15px;
}

.inputLogin:focus {
    outline: none;
}

.inputArea {
    margin-top: 10px;
}


.verificationAlert{
    text-align: center;
    margin-bottom: 15px;
    font-size: 18px;
}

.registrationStep{
    text-align: center;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}
.noticeAddProblemArea{
	margin-top: 15px;
}
.addProblemArea{
	font-family: "Exo 2";
}

</style>

<div class="addProblemArea">

<div class="row">
	<div class="col-md-4 loginInputTitleTxt">
		Problem Name:
	</div>
	<div class="col-md-8">
		<input type="text"  autocomplete="off" class="inputLogin" id="problemName" placeholder="Enter Problem Name">
	</div>
	<div class="col-md-4 loginInputTitleTxt">
		Time Limit:
	</div>
	<div class="col-md-8">
		<input type="number" id="problemTimeLimit" placeholder='Enter Problem Time Limit' class="inputLogin">
	</div>
	<div class="col-md-4 loginInputTitleTxt">
		Memory Limit:
	</div>
	<div class="col-md-8">
		<input type="number" placeholder='Enter Problem Memory Limit' id="problemMemoryLimit" class="inputLogin">
	</div>	
</div>
<div class="noticeAddProblemArea">
	*Time Limit Unit is Second (s) and Default Time Limit 2s<br/>
	*Memory Limit Unit is Kilobyte (kb) and Default Memory Limit 128000 kb<br/>
</div>

</div>

<button class="loginBtn" id="addProblem" style="font-size: 15px;font-weight: bold;margin-top: 20px; width: 100%; padding: 13px" onclick="addProblem()">+ Add Problem</button>
