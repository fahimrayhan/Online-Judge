<?php

namespace App\Services\FileManager;

use App\Models\FileManager;
use Hash;
use Illuminate\Support\Str;

class FileManagerService
{
    public function uploadImage($data)
    {
        $file = $data->file;
        $fileName = hash('sha256', auth()->user()->handle . '-' . Str::random(20) . "-" . time()) . "." . $file->extension();
        $fileManager = FileManager::create([
            'file_name' => $fileName,
            'user_id' => auth()->user()->id,
            'size' => round($file->getSize() / 1024),
            'type' => $file->getClientOriginalExtension(),
        ]);
        $file->move(public_path($fileManager->filePath), $fileName);
    }

    public function getAllFiles()
    {
        return auth()->user()->files;
    }

    public function getFile($id)
    {
        return FileManager::findOrFail($id);
    }

    public function deleteFile(FileManager $file)
    {
        // unlink(public_path($user->avatarPath).$baseName);
        $baseName = basename($file->file_name);
        unlink(public_path($file->filePath) . $baseName);
        $file->delete();
    }
}
