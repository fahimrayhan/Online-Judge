
<style type="text/css">
    .editorArea{
        background-color: #ffffff;
        border: 1px solid #D1D9E5;
        border-radius: 5px;
    }
    .editorAreaTop{
        padding: 10px;
    }
    .editorAreaBottom{
        padding: 10px;
    }
    .editor{
        border: 1px solid #D1D9E5;
        border-width: 1px 0px 1px 0px;
    }
    .editorError{
        color: #A94442;
        font-weight: bold;
    }
    .editorLanguageSelect{
        padding: 5px;
    }
    .editorIcon{
        font-size: 15px;
        margin-right: 10px;
        cursor: pointer;
        background-color: #7f8c8d;
        color: #ffffff;
        padding: 8px;
        text-align: center;
        border-radius: 100%;
        width: 30px;
        height: 30px;
        font-weight: bold;
    }
    .editorIcon:hover{
        background-color: var(--bg-color);
        color: #ecf0f1;
    }
    .editorBtnArea{
        text-align: center;
    }
</style>


<div class="editorArea">
    <div class="editorAreaTop">
        <div class="row">
            <div class="col-md-3">
                <div class="editorBtnArea">
                    <i class="fa fa-copy editorIcon" title="Copy"></i>
                    <input type="file" name="file" id="sourceCode" onchange="loadSourceCodeFile(event)" style="display:none"/> 
                    <i class="far fa-folder-open editorIcon" id="openFile" title="Open File"></i>
                    <i class="fas fa-file-download editorIcon" onclick="downloadEditorSourceCode()" title="Download"></i>
                </div>

            </div>
            <div class="col-md-5"></div>
            <div class="col-md-4">
                 <select class='form-control editorLanguageSelect' id='selectLanguage' onclick='changeLanguage()'>
            <?php 
                $languageList = $Submission->getJudgeLanguageList();
                foreach ($languageList as $key => $value) {
                    echo "<option value=".$value['languageId'].">".$value['languageName']."</option>";
                }
            ?>
                </select>
            </div>
            
            
        </div>
    </div>
    <div id="sourceCodeEditor" onkeyup="changeTemplate()" class="editor"></div>
    <div class="editorAreaBottom">
       <div class="row">
           <div class="col-md-8">
               
           </div>
           <div class="col-md-4">
                <div class="pull-right">
                    <button style="width: 150px;" id="btnCreateSubmit" onclick="createSubmission()">Submit Solution</button>
                </div>
           </div>
       </div>
    </div>
</div>
<script type="text/javascript" src="views/editor/js/editor_script.js"></script>
<script type="text/javascript" src="views/editor/js/download.js"></script>