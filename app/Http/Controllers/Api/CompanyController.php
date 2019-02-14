<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Resources\CompanyResource;
use App\Mail\NewCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $records = Company::paginate(10);
        return CompanyResource::collection($records);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CompanyResource
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'email',
            'logo' => 'image',
            'website' => 'string|min:10',
        ]);

        $company = Company::create($validatedData);

        Mail::to(auth()->user()->email)->send(new NewCompany());

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return CompanyResource
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Company $company
     * @return CompanyResource
     */
    public function updateWithImage(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'string|min:3',
            'email' => 'email',
            'logo' => 'image',
            'website' => 'string|min:10',
        ]);

        $company->update($validatedData);

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['Resource was deleted'], 200);
    }
}
