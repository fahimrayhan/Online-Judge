function loadFormSerial(){
	//modal.md.open("Update Form Seiral");
	loader("update_serial");
	$.post("contest_arena_action.php", { 'loadFormSerial': 1}, function(response) {
       // modal.md.setBody(response);
    	$("#update_serial").html(response);
    });
}