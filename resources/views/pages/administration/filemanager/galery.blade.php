<style type="text/css">
    .uploadTd1 {
        padding: 0px;
        width: 100px;
    }

    .file-manager .top-button{
        background-color: #000000;
        height: 100px;
        width: 100px;
    }

    .file-manager .file-area{
        border: 1px solid #dddddd;
        padding: 5px;
        height: 350px;
        margin-bottom: 10px;
    }
    .file-manager img{
        height: 200px;
        width: 100%;
    }
    .file-manager .td1{
        background-color: #F4F6F8;
        border: 1px solid #dddddd;
        padding: 5px;
        font-weight: bold;
        font-size: 13px;
        width: 100px;
    }
    .file-manager .td2{
        border: 1px solid #dddddd;
        padding: 5px;
        font-size: 13px;
    }
</style>

   
<form style="display: none" action="{{ route('administration.filemanager.upload') }}" method="POST" enctype="multipart/form-data"
        id="upload_image">
        @csrf
        <input type="file" name="file" id="file" onchange="fileManager.loadFile(event)" /></center>
</form>


<div class="file-manager">

<button class="btn btn-primary" onclick="$('#file').trigger('click')">Upload</button>

<div class="box_body" style="margin-top: 15px;">
        <div class="row">
            @foreach ($files as $file)
                <div class="col-md-4">
                    <div class="file-area">
                        <a href="{{ $file->file_name }}" target="_blank"><img class="img-thumbnail"
                                src="{{ $file->file_name }}"></a>
                        <div class="uploadBtnArea" style="padding: 10px;">
                            <p style="display: none" id="{{ $file->file_name }}">{{ $file->file_name }}</p>
                            <div style="margin-bottom: 8px;">
                                <table width="100%">
                                    <tr>
                                        <td class="td1 uploadTd1">File Size</td>
                                        <td class="td2">{{ $file->size }} KB</td>
                                    </tr>
                                    <tr>
                                        <td class="td1 uploadTd1">File Type</td>
                                        <td class="td2">{{ $file->type }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td1 uploadTd1">Added Date</td>
                                        <td class="td2">{{ $file->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div style="text-align: center;">
                            <button onclick="fileManager.selectEditor('{{ $file->file_name }}')"
                                class="btn btn-sm btn-primary"><i class='fas fa-copy'></i> Select</button>
                            <button class="btn btn-sm btn-danger" onclick="fileManager.delete($(this))"
                                url="{{ route('administration.filemanager.delete', ['id' => $file->id]) }}"><i
                                    class="fas fa-trash"></i>
                                Delete
                                Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

