<?php

namespace App\Http\Controllers\Administration\Language;

use App\Http\Controllers\Controller;
use App\Services\Language\LanguageService;
use Illuminate\Http\Request;

class LanguageDashboardController extends Controller
{
    protected $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }
    
    public function show()
    {
        $languages = $this->languageService->allLanguages();
        if(isset(request()->archived))
        {
            $languages = $languages->where('is_archive',1);
        }
        else
        {
            $languages = $languages->where('is_archive',0);
        }
        return view('pages.administration.settings.language.index',['languages' => $languages]);
    }
}
