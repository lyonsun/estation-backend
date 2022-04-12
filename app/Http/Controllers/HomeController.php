<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    //

    public function index(Request $request) {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('APP_URL') . "/api/stations/nearby?latitude=$latitude&longitude=$longitude&radius=$radius");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($output, false);

        $stations = !empty($result->data) ? $result->data : [];

        return view('welcome', [
            'stations' => $stations,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => $radius,
        ]);
    }
}
