<script type="text/javascript" src="style/lib/jquery/jquery.min.js"></script>
<div id='response'></div>





<script type="text/javascript">
	var process=0;
	//callServer();
	setInterval(function(){ 
		if(process==0){
			callServer();
		}
	}, 1000);

	function callServer() {
  		$.get("test_judge_server.php",function(response) { 
    		$("#response").html(response);
  			//callServer();
  		});
	}
</script>