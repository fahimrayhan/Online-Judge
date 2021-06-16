<?php

namespace App\Http\Controllers\Administration\FileManager;

use App\Http\Controllers\Controller;
use App\Services\FileManager\FileManagerService;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    protected $fileManagerService;
    protected $fileManagerData;
    public function __construct(FileManagerService $fileManagerService)
    {
        $this->fileManagerService = $fileManagerService;
        if (isset(request()->id)) {
            $this->fileManagerData = $this->fileManagerService->getFile(request()->id);
        }
    }
    public function structure()
    {
        return view('pages.administration.filemanager.structure');
    }

    public function loadUploadArea()
    {
        return view('pages.administration.filemanager.upload_area');
    }

    public function upload(Request $request)
    {
        $this->fileManagerService->uploadImage($request);
        return response()->json([
            'message' => "File Is Uploaded Successfully",
            'url' => route('administration.filemanager.galery')
        ]);
    }

    public function galery()
    {
        $file = $this->fileManagerService->getAllFiles()->first();
        // dd("Hello");
        return view('pages.administration.filemanager.galery', [
            'files' => $this->fileManagerService->getAllFiles()
        ]);
    }

    public function delete()
    {
        $this->fileManagerService->deleteFile($this->fileManagerData);
        return response()->json([
            'message' => "File Deleted Successfully",
            'url' => route('administration.filemanager.galery')
        ]);
    }
}
