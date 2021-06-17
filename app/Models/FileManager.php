<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    protected $fillable = [
        'file_name', 'user_id', 'size', 'type'
    ];

    protected $appends = ['filePath'];

    public function getFilePathAttribute()
    {
        return 'upload/files/';
    }
    public function getFileNameAttribute($fileName)
    {
        return asset($this->filePath . $fileName);
    }
}
