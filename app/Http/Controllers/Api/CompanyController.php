<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $companies = Company::with('parent')->get();

        return response()->json([
            'message' => 'All companies retrieved successfully.',
            'data' => $companies,
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @bodyParam name string required The name of the company.
     * @bodyParam parent_company_id int required The id of the parent company.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $company = Company::create($request->all());

        return response()->json([
            'message' => 'Company created successfully',
            'data' => $company
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company) {
        //
        $company = Company::with('parent')->find($company->id);

        return response()->json([
            'message' => 'Company retrieved successfully',
            'data' => $company
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @bodyParam name string required The name of the company.
     * @bodyParam parent_company_id int required The id of the parent company.
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company) {
        //
        $company->update($request->all());

        return response()->json([
            'message' => 'Company updated successfully',
            'data' => $company
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company) {
        //
        $company->delete();

        return response()->json([
            'message' => 'Company deleted successfully'
        ], Response::HTTP_NO_CONTENT);
    }
}
