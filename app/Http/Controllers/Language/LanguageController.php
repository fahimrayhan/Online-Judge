<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageCreateRequest;
use App\Services\Language\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    protected $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function create()
    {
        return view('pages.language.dashboard.create');
    }
    public function store(LanguageCreateRequest $request)
    {
        $this->languageService->createLanguage($request->all());
        return response()->json([
            'message' => 'Language Successfully Created',
        ]);
    }
}
