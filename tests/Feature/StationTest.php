<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationTest extends TestCase {
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test create a new station.
     *
     * @return void
     */
    public function test_create_new_station() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $response = $this->postJson('/api/stations', [
            'name' => 'Test Station',
            'address' => 'Test Address',
            'latitude' => '60.123456',
            'longitude' => '24.123456',
            'company_id' => $company_id
        ]);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test get all stations.
     *
     * @return void
     */
    public function test_get_all_stations() {
        $response = $this->getJson('/api/stations');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test get a station.
     *
     * @return void
     */
    public function test_get_station() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $station_response = $this->postJson('/api/stations', [
            'name' => 'Test Station',
            'address' => 'Test Address',
            'latitude' => '60.123456',
            'longitude' => '24.123456',
            'company_id' => $company_id
        ]);

        $station_id = $station_response->json()['data']['id'];

        $response = $this->getJson('/api/stations/' . $station_id);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test get all stations nearby.
     *
     * @return void
     */
    public function test_get_all_stations_nearby() {
        $response = $this->getJson('/api/stations/nearby?latitude=60.123456&longitude=24.123456&radius=100');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test update a station.
     *
     * @return void
     */
    public function test_update_station() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $station_response = $this->postJson('/api/stations', [
            'name' => 'Test Station',
            'address' => 'Test Address',
            'latitude' => '60.123456',
            'longitude' => '24.123456',
            'company_id' => $company_id
        ]);

        $station_id = $station_response->json()['data']['id'];

        $response = $this->putJson('/api/stations/' . $station_id, [
            'name' => 'Test Station',
            'address' => 'Test Address',
            'latitude' => '60.123456',
            'longitude' => '24.123456',
            'company_id' => $company_id
        ]);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test delete a station.
     *
     * @return void
     */
    public function test_delete_station() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $station_response = $this->postJson('/api/stations', [
            'name' => 'Test Station',
            'address' => 'Test Address',
            'latitude' => '60.123456',
            'longitude' => '24.123456',
            'company_id' => $company_id
        ]);

        $station_id = $station_response->json()['data']['id'];

        $response = $this->deleteJson('/api/stations/' . $station_id);

        $response->assertStatus(204);
    }
}
