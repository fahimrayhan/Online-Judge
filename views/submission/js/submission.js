var url="submission_action.php";
var submissionId=108;
getSubmissionAllInfo();

function getSubmissionAllInfo(){
	var data = {
		'submissionId': submissionId
	}
	$.post(url,buildData("getSubmissionAllInfo",data),function(response){
		var info = JSON.parse(response);
		$("#result").html(info.submissionInfo.userId);
		setSubmissionInfo();
	});

}


function setSubmissionInfo(){
		var row = 0;
		var col = 2

		var cell = $('table tr:eq(' + row + ') td:eq(' + col + ')');
		cell.append("hello");
		$('table tr:eq(' + row + ') td:eq(' + col + ')').text("workig");
		console.log(cell.text());
		$('#submission_table tr:last').after('<tr><td>hey</td></tr>');
}

function setRowData(tableId, rowId, colNum, newValue)
{
    $('#'+tableId).find('tr:eq(rowId)').find('td:eq(colNum)').html(newValue);
};

function appendData(tableId){
	$('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');
}

