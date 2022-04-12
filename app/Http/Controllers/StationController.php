<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StationController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $stations = json_decode($output, false);

        return view('stations.index', ['stations' => $stations->data]);
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

        return view('stations.create', ['companies' => $companies->data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "name=" . $request->name
                . "&latitude=" . $request->latitude
                . "&longitude=" . $request->longitude
                . "&address=" . $request->address
                . "&company_id=" . $request->company_id
        );

        $output = curl_exec($ch);
        curl_close($ch);

        return redirect('/stations')->with('success', 'Station has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show($station_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations/" . $station_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $station = json_decode($output, false);

        return view('stations.show', ['station' => $station->data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($station_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations/" . $station_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $station = json_decode($output, false);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/companies");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $companies = json_decode($output, false);

        return view('stations.edit', ['station' => $station->data, 'companies' => $companies->data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, $station_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations/" . $station_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "name=" . $request->name
                . "&latitude=" . $request->latitude
                . "&longitude=" . $request->longitude
                . "&address=" . $request->address
                . "&company_id=" . $request->company_id
        );

        $output = curl_exec($ch);
        curl_close($ch);

        return redirect('/stations')->with('success', 'Station has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($station_id) {
        //
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations/" . $station_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $output = curl_exec($ch);
        curl_close($ch);

        return redirect('/stations')->with('success', 'Station has been deleted');
    }
}
