<?php

namespace App\Http\Controllers\Administration\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Country\CountryService;
use App\Http\Requests\Country\CreateCountryRequest;
use App\Http\Requests\Country\UpdateCountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    //
    protected $countryService;
    protected $countryData;
    
    public function __construct(countryService $countryService)
    {
        $this->countryService = $countryService;
        if (isset(request()->Id)) {
           $this->countryData = $this->countryService->getCountry(request()->Id);
        }
        
    }
   
    public function index()
    {

        return view('pages.administration.settings.country.index',[
            'countries' => $this->countryService->getAllCountry()
        ]);
    }

    public function create()
    {
        return view('pages.administration.settings.country.create');
    }

    public function store(CreateCountryRequest $request)
    {
        $this->countryService->createCountry($request->all());
        
        return response()->json([
            'message' => "Country Created Successfully"
        ]);
    }

    public function edit()
    {
        return view('pages.administration.settings.country.edit',['country' => $this->countryData]);
    }
    
    public function update(UpdateCountryRequest $request)
    {
        $this->countryService->updateCountry($this->countryData,$request->all());
        return response()->json([
            'message' => "Country Is Updated Successfully"
        ]);
    }

    public function delete()
    {
        $this->countryData->delete();
        return response()->json([
            "message" => "Country is Deleted Successfully"
        ]);
    }
   
   
}
