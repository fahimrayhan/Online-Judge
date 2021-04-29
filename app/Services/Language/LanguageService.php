<?php
namespace App\Services\Language;
use App\Models\Language;

class LanguageService
{
    public function createLanguage($data)
    {
        return Language::create($data);
    }

    public function allLanguages()
    {
        return  Language::all();
    }
    
}
