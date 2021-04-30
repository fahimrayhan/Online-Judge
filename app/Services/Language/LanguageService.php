<?php

namespace App\Services\Language;

use App\Models\Language;

class LanguageService
{
    public function createLanguage($data)
    {

        return Language::create($data);
    }
    public function updateLanguage(Language $language, $data)
    {
        $language->name = $data['name'];
        $language->code = $data['code'];
        $language->save();
        return $language;
    }
    public function allLanguages()
    {
        return  Language::all();
    }

    public function getLanguage($language_id)
    {
        return Language::find($language_id);
    }
}
