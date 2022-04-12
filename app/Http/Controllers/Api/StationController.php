<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $stations = Station::with('company')->get();

        return response()->json([
            'message' => 'All stations retrieved successfully.',
            'data' => $stations,
        ], Response::HTTP_OK);
    }

    /**
     * Display a list of stations within the radius of n kilometers from a point (latitude, longitude), and stations in the same location are grouped together.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @queryParam latitude number required The latitude of the point.
     * @queryParam longitude number required The longitude of the point.
     * @queryParam radius number required The radius in kilometers.
     * @return \Illuminate\Http\Response
     */
    public function nearby(Request $request) {
        //
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius');

        $result_stations = [];

        $matched_stations = Station::selectRaw(
            '*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
            [$latitude, $longitude, $latitude]
        )
            ->having('distance', '<', $radius)
            ->orderBy('distance', 'asc')
            ->get();

        foreach ($matched_stations as $station) {
            $children_stations = [];

            $company_ids = $station->company->getAllDescendants()->pluck('id');

            $company_ids[] = $station->company->id;

            if (!isset($children_stations[$station->id])) {
                // get all stations having company_id in $company_ids
                $children_stations = Station::whereIn('company_id', $company_ids)->get();
            }

            $station['all_company_stations'] = $children_stations;

            $result_stations[$station->address][] = $station;
        }

        return response()->json([
            'message' => 'Stations nearby retrieved successfully.',
            'data' => $result_stations,
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
     * @bodyParam name string required The name of the station.
     * @bodyParam address string required The address of the station.
     * @bodyParam latitude number required The latitude of the station.
     * @bodyParam longitude number required The longitude of the station.
     * @bodyParam company_id int required The id of the company.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $station = Station::create($request->all());

        return response()->json([
            'message' => 'Station created successfully',
            'data' => $station
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station) {
        //
        $station = Station::with('company')->find($station->id);

        return response()->json([
            'message' => 'Station retrieved successfully',
            'data' => $station,
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @bodyParam name string required The name of the station.
     * @bodyParam address string required The address of the station.
     * @bodyParam latitude number required The latitude of the station.
     * @bodyParam longitude number required The longitude of the station.
     * @bodyParam company_id int required The id of the company.
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Station $station) {
        //
        $station->update($request->all());

        return response()->json([
            'message' => 'Station updated successfully',
            'data' => $station,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station) {
        //
        $station->delete();

        return response()->json([
            'message' => 'Station deleted successfully',
            'data' => $station,
        ], Response::HTTP_NO_CONTENT);
    }
}
