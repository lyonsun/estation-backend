<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $companies = json_decode($output, false);

        return view('companies.index', ['companies' => $companies->data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $companies = json_decode($output, false);

        return view('companies.create', ['companies' => $companies->data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "name=" . $request->name
                . "&parent_company_id=" . $request->parent_company_id
        );

        $output = curl_exec($ch);
        curl_close($ch);

        return redirect('companies')->with('success', 'Company has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show($company_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies/" . $company_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $company = json_decode($output, false);

        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($company_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies/" . $company_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $company = json_decode($output, false);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $companies = json_decode($output, false);

        return view('companies.edit', ['company' => $company->data, 'companies' => $companies->data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, $company_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies/" . $company_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "name=" . $request->name
                . "&parent_company_id=" . $request->parent_company_id
        );

        $output = curl_exec($ch);
        curl_close($ch);

        return redirect('companies')->with('success', 'Company has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($company_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies/" . $company_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $output = curl_exec($ch);
        curl_close($ch);

        return redirect('companies')->with('success', 'Company has been deleted');
    }
}
