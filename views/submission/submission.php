<script type="text/javascript" src="views/submission/js/submission.js"></script>
<div class='row'>
    <div class='col-md-12'>
        <div class="box">
        	<div class="box_header">Submission</div>
           	<div class="box_body">
                <div id="result"></div>
           		<table width="100%" id="submission_table" class="table">
                	<tr>
                		<td class="td1">#</td>
                		<td class="td1">Author</td>
                		<td class="td1">Problem</td>
                		<td class="td1">Time</td>
                		<td class="td1">Language</td>
                		<td class="td1">CPU</td>
                		<td class="td1">Memory</td>
                		<td class="td1">Verdict</td>
                	</tr>
                	<tr>
                		<td class="td2">1110</td>
                		<td class="td2">Author</td>
                		<td class="td2">Problem</td>
                		<td class="td2">Time</td>
                		<td class="td2">Language</td>
                		<td class="td2">CPU</td>
                		<td class="td2">Memory</td>
                		<td class="td2">Verdict</td>
                	</tr>
            	</table>
           	</div>
        </div>
    </div>
    <div class='col-md-6'>
    	<div class="box">
    		<div class="box_header">Test Cases</div>
    		<div class="box_body">
    			<table width="100%">
                	<tr>
                		<td class="td1">#</td>
                		<td class="td1">CPU</td>
                		<td class="td1">Time</td>
                		<td class="td1">Verdict</td>
                	</tr>
                	<?php for($i=1; $i<10; $i++){ ?>
                	<tr>
                		<td class="td2">#</td>
                		<td class="td2">CPU</td>
                		<td class="td2">Time</td>
                		<td class="td2">Verdict</td>
                	</tr>
                	<?php } ?>
                </table>
    		</div>
    	</div>
    </div>
    <div class='col-md-6'></div>
</div>

