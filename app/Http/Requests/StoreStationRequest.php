<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStationRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
            "name" => "required|string|max:255",
            "latitude" => "required|float|max:180|min:-180",
            "longitude" => "required|float|max:180|min:-180",
            "address" => "required|string|max:255",
            "company_id" => "required|integer",
        ];
    }
}
