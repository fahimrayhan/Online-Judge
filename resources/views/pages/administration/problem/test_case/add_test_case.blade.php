<form class="" action="{{route('administration.problem.test_case.add',['slug' => request()->slug])}}" id="add_test_case" method="post" enctype="multipart/form-data">
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

   </style>
   <div class="row">
      <div class="col-md-12" style="margin-top: -5px">
         <div class="alert-area">
            <div class="alert alert-danger error-area"></div>
            <div class="alert alert-success success-area"></div>
         </div>
      </div>
      <div class="col-md-12">
         <div style="margin-top: -15px;"></div>
         <b style='font-size: 17px;'>Point</b> 
         <input type="number" name="point" id="testCasePoint" style="width: 250px;" class="form-control" value="1" placeholder="Enter Test Case Point">
         <div style="margin-bottom: 10px;"></div>
      </div>
      <div class="col-md-7"><b style='font-size: 17px;'>Input</b></div>
      <div class="col-md-5">
         <label class="radio-inline"><input type="radio" value="editor" onclick="testCase.selectInputType(this)" name="input_type" checked>Editor</label>
         <label class="radio-inline"><input type="radio" value="upload" onclick="testCase.selectInputType(this)" name="input_type">Upload</label>
      </div>
      <div class="col-md-12" style="margin-bottom: 20px;">
         <div class="testCaseEditorArea">
            <div id="testCaseInputEditorArea">
               <textarea maxlength='5000' class='testCaseTextAreaEditor' name="input" maxlength="5000" onkeyup="testCase.setInputEditorLimit(this)" id='testCaseInput' placeholder="Enter Your Input"></textarea>
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
               <textarea maxlength='5000' class='testCaseTextAreaEditor' name="output" maxlength="5000" onkeyup="testCase.setOutputEditorLimit(this)" id='testCaseOutput' placeholder="Enter Your Output"></textarea>
            </div>
            <div class="testCaseUploadArea" id="testCaseOutputUploadArea" style="display: none;">
               <center><input type="file" name="output_file"></center>
            </div>
         </div>
      </div>
   </div>
   <div style="margin-top: 15px;"></div>
   <center><button type="submit" class="btn btn-primary" id="addTestCase" onclick='testCase.addTestCase()'>Add Test Case</button></center>
</form>