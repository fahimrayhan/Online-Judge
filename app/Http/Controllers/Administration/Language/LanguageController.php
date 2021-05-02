<?php

namespace App\Http\Controllers\Administration\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageCreateRequest;
use App\Http\Requests\Language\LanguageUpdateRequest;
use App\Services\Language\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    protected $languageService;
    private $languageData;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
        if (isset(request()->language_id)) {
            $this->languageData = $this->languageService->getLanguage(request()->language_id);
        }
    }

    public function create()
    {
        return view('pages.administration.settings.language.create');
    }

    public function store(LanguageCreateRequest $request)
    {
        // dd("Controller Class");
        $this->languageService->createLanguage($request->all());
        return response()->json([
            'message' => 'Language Successfully Created',
        ]);
    }

    public function edit()
    {
        return view('pages.administration.settings.language.edit', ['language' => $this->languageData]);
    }

    public function update(LanguageUpdateRequest $request)
    {
        $this->languageData = $this->languageService->updateLanguage($this->languageData, $request->all());
        return response()->json([
            'message' => 'Language Successfully Updated',
        ]);
    }

    public function toggleArchive()
    {
        $this->languageData->is_archive = !$this->languageData->is_archive;
        $this->languageData->save();
        $msg = $this->languageData->is_archive ? "Archived" : "Restore From Archived";
        return response()->json([
            'message' => 'Language Successfully ' . $msg,
        ]);
    }
}
