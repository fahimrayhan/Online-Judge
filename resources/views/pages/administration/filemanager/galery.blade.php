<style type="text/css">
    .uploadTd1 {
        padding: 0px;
        width: 100px;
    }

</style>


<div class="boxx">

    <div class="box_bodyy">
        <div class="row">
            @foreach ($files as $file)


                <div class="col-md-4">
                    <div class="box_body uploadImgBox">
                        <a href="{{ $file->file_name }}" target="_blank"><img class="uploadImage img-thumbnail"
                                src="{{ $file->file_name }}"></a>
                        <div class="uploadBtnArea">
                            <p style="display: none" id="{{ $file->file_name }}">{{ $file->file_name }}</p>
                            <div style="margin-bottom: 0px;">
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
                            <input type="text" value="{{ $file->file_name }}" id="cpyPath_{{ $file->file_name }}">
                            <button onclick="fileManager.copyFilePath('cpyPath_{{ $file->file_name }}')"
                                class="btn-sm btn-primary"><i class='fas fa-copy'></i> Copy Url</button>
                            <button class="btn-sm btn-danger" onclick="fileManager.delete($(this))"
                                url="{{ route('administration.filemanager.delete', ['id' => $file->id]) }}"><i
                                    class="fas fa-trash"></i>
                                Delete
                                Image</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
