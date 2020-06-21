

<style type="text/css">
	.testCaseEditorArea{
		height: 180px;
	}
	.testCaseUploadArea{
		background-color: #ffffff;
		text-align: center;
		padding-top: 80px;
		height: 100%;
		border: 1px solid #767676;
	}
	.testCaseTextAreaEditor{
		height: 180px;
		width: 100%;
		background-color: #f5f5f5;
		resize: none;
		padding: 5px;
	}
	.testCaseUrlArea{
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
		<label class="radio-inline"><input type="radio" value="editor" onclick="problemTestCase.selectInputType(this)" name="inputOption" checked>Editor</label>
		<label class="radio-inline"><input type="radio" value="upload" onclick="problemTestCase.selectInputType(this)" name="inputOption">Upload</label>
		<label class="radio-inline"><input type="radio" value="url" onclick="problemTestCase.selectInputType(this)" name="inputOption">Url</label>
	</div>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<div class="testCaseEditorArea">
			<div id="testCaseInputEditorArea">
				<textarea class='testCaseTextAreaEditor' maxlength="5000" onkeyup="problemTestCase.setInputEditorLimit()" id='testCaseInputEditor' placeholder="Enter Your Input"></textarea>
			</div>
			<div class="testCaseUploadArea" id="testCaseInputUploadArea" style="display: none;">
				<center><input type="file" id="testCaseInputUpload" onchange="problemTestCase.uploadInputFile(event)"></center>
			</div>
			<div class="testCaseUrlArea" id="testCaseInputUrlArea" style="display: none;">
				<input type="text" id="testCaseInputUrl" placeholder="Enter Input URL">
			</div>
		</div>
	</div>
	<div class="col-md-7"><b style='font-size: 17px;'>Output</b></div>
	<div class="col-md-5">
		<label class="radio-inline"><input type="radio" value="editor" onclick="problemTestCase.selectOutputType(this)" name="outputOption" checked>Editor</label>
		<label class="radio-inline"><input type="radio" value="upload" onclick="problemTestCase.selectOutputType(this)" name="outputOption">Upload</label>
		<label class="radio-inline"><input type="radio" value="url" onclick="problemTestCase.selectOutputType(this)" name="outputOption">Url</label>
	</div>
	<div class="col-md-12">
		<div class="testCaseEditorArea">
			<div id="testCaseOutputEditorArea">
				<textarea class='testCaseTextAreaEditor' maxlength="5000" onkeyup="problemTestCase.setOutputEditorLimit()" id='testCaseOutputEditor' placeholder="Enter Your Output"></textarea>
			</div>
			<div class="testCaseUploadArea" id="testCaseOutputUploadArea" style="display: none;">
				<center><input type="file" id="testCaseOutputUpload" onchange="problemTestCase.uploadOutputFile(event)"></center>
			</div>
			<div class="testCaseUrlArea" id="testCaseOutputUrlArea" style="display: none;">
				<input type="text" id="testCaseOutputUrl" placeholder="Enter Output URL">
			</div>
		</div>
	</div>
</div>
<div style="margin-top: 15px;"></div>
<center><button id="addTestCase" onclick='problemTestCase.saveTestCase()'>Add Test Case</button></center>
