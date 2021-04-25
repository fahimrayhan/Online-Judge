<form action="{{route('administration.problem.test_case.add',['slug' => request()->slug])}}" method="post">
	@csrf
	

<style type="text/css">
	.testCaseEditorAreaa{
		height: 180px;
	}
	.testCaseUploadAreaa{
		background-color: #ffffff;
		text-align: center;
		padding-top: 80px;
		height: 100%;
		border: 1px solid #767676;
	}
	.testCaseTextAreaEditorr{
		height: 180px;
		width: 100%;
		background-color: #f5f5f5;
		resize: none;
		padding: 5px;
	}
	.testCaseUrlAreaa{
		background-color: #ffffff;
		text-align: center;
		padding-top: 80px;
		height: 100%;
		padding: 60px 10px 0px 10px;
		border: 1px solid #767676;
	}
</style>
<div id="response"></div>
<div class="row">
	<div class="col-md-7"><b style='font-size: 17px;'>Input</b></div>
	<div class="col-md-5">
		<label class="radio-inline"><input type="radio" value="editor" onclick="problemTestCase.selectInputType(this)" name="input_type" checked>Editor</label>
		<label class="radio-inline"><input type="radio" value="upload" onclick="problemTestCase.selectInputType(this)" name="input_type">Upload</label>
	</div>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<div class="testCaseEditorArea">
			<div id="testCaseInputEditorArea">
				<textarea class='testCaseTextAreaEditor' name="input" maxlength="5000" onkeyup="testCase.updateField(this)" id='testCaseInput' placeholder="Enter Your Input"></textarea>
			</div>
			<div class="testCaseUploadArea" id="testCaseInputUploadArea" style="">
				<center><input type="file" name="input-file"></center>
			</div>
		</div>
	</div>
	<div class="col-md-7"><b style='font-size: 17px;'>Output</b></div>
	<div class="col-md-5">
		<label class="radio-inline"><input type="radio" value="editor" onclick="problemTestCase.selectOutputType(this)" name="output_type" checked>Editor</label>
		<label class="radio-inline"><input type="radio" value="upload" onclick="problemTestCase.selectOutputType(this)" name="output_type">Upload</label>
	</div>
	<div class="col-md-12">
		<div class="testCaseEditorArea">
			<div id="testCaseOutputEditorArea">
				<textarea class='testCaseTextAreaEditor' name="output" maxlength="5000" onkeyup="testCase.updateField(this)" id='testCaseOutput' placeholder="Enter Your Output"></textarea>
			</div>
			<div class="testCaseUploadArea" id="testCaseOutputUploadArea" style="display: none;">
				<center><input type="file" name="output-file"></center>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div style="margin-top: 15px;"></div>
		<b style='font-size: 17px;'>Point</b> 
		<input type="number" name="point" id="testCasePoint" class="inputClass" value="1" placeholder="Enter Test Case Point">
	</div>
</div>
<div style="margin-top: 15px;"></div>
<center><button id="addTestCase" onclick='testCase.addTestCase()'>Add Test Case</button></center>
<input type="submit" name="">

</form>
