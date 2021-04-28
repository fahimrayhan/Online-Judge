<form class="" action="{{route('problem.test_case.edit',['slug' => request()->slug,'test_case_id' => request()->test_case_id])}}" id="update_test_case" method="post" enctype="multipart/form-data">

   @csrf
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
      	background-color: #f9f9f9;
      	resize: none;
      	padding: 5px;
      }
      .testCaseTextAreaEditor:focus{
      	outline: none;
      }
      .testCaseUrlArea{
      	background-color: #ffffff;
     	text-align: center;
      	padding-top: 80px;
      	height: 100%;
      	padding: 60px 10px 0px 10px;
      	border: 1px solid #767676;
      }

      .editorAlert{
		background-color: #f5f5f5;
		text-align: center;
		padding-top: 90px;
		height: 180px;
		font-weight: bold;
		font-size: 20px;
		padding: 60px 10px 0px 10px;
		border: 1px solid #767676;
	}
      .error-area,.success-area{
      	display: none;
      }
      .error-input{
      	border: solid 1px #ce9999;
      }
      .alert-area{
      	margin-bottom: 15px;
      }
   </style>

   <div class="row">
      <div class="col-md-12">
         <div class="alert-area">
            <div class="alert alert-danger error-area"></div>
            <div class="alert alert-success success-area"></div>
         </div>
      </div>
      <div class="col-md-7"><b style='font-size: 17px;'>Input</b></div>
      <div class="col-md-5">
         <label class="radio-inline"><input type="radio" value="editor" onclick="testCase.selectInputType(this)" name="input_type" checked>Editor</label>
         <label class="radio-inline"><input type="radio" value="upload" onclick="testCase.selectInputType(this)" name="input_type">Upload</label>
      </div>
      <div class="col-md-12" style="margin-bottom: 20px;">
         <div class="testCaseEditorArea">
            <div id="testCaseInputEditorArea">
               <textarea style="display: {{$testCase->inputLength() >= 5000 ? 'none':'block'}}" maxlength='5000' class='testCaseTextAreaEditor' name="input" maxlength="5000" onkeyup="testCase.setInputEditorLimit(this)" id='testCaseInput' placeholder="Enter Your Input">{{$testCase->input()}}</textarea>
               @if($testCase->inputLength() >= 5000)
                  <div class='editorAlert'>Input File Is To Large. If You Need Large Input You Try Upload Option.</div>
               @endif
            </div>
            <div class="testCaseUploadArea" id="testCaseInputUploadArea" style="display: none">
               <center><input type="file" name="input_file"></center>
            </div>
         </div>
      </div>
      <div class="col-md-7"><b style='font-size: 17px;'>Output</b></div>
      <div class="col-md-5">
         <label class="radio-inline"><input type="radio" value="editor" onclick="testCase.selectOutputType(this)" name="output_type" checked>Editor</label>
         <label class="radio-inline"><input type="radio" value="upload" onclick="testCase.selectOutputType(this)" name="output_type">Upload</label>
      </div>
      <div class="col-md-12">
         <div class="testCaseEditorArea">
            <div id="testCaseOutputEditorArea">
               <textarea style="display: {{$testCase->outputLength() >= 5000 ? 'none':'block'}}" maxlength='5000' class='testCaseTextAreaEditor' name="output" maxlength="5000" onkeyup="testCase.setOutputEditorLimit(this)" id='testCaseOutput' placeholder="Enter Your Output">{{$testCase->output()}}</textarea>
               @if($testCase->outputLength() >= 5000)
                  <div class='editorAlert'>Output File Is To Large. If You Need Large Input You Try Upload Option.</div>
               @endif
            </div>
            <div class="testCaseUploadArea" id="testCaseOutputUploadArea" style="display: none;">
               <center><input type="file" name="output_file"></center>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div style="margin-top: 15px;"></div>
         <b style='font-size: 17px;'>Point</b> 
         <input type="number" name="point" id="testCasePoint" class="inputClass" value="{{$testCase->point}}" placeholder="Enter Test Case Point">
      </div>
   </div>
   <div style="margin-top: 15px;"></div>
   <center><button type="submit" class="btn btn-success" id="addTestCase" onclick='testCase.updateTestCase()'>Update Test Case</button></center>
</form>