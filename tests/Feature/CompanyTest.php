<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase {
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test create a new company.
     *
     * @return void
     */
    public function test_create_new_company() {
        $response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test get all companies.
     *
     * @return void
     */
    public function test_get_all_companies() {
        $response = $this->getJson('/api/companies');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test get a company.
     *
     * @return void
     */
    public function test_get_company() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $response = $this->getJson('/api/companies/' . $company_id);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test update a company.
     *
     * @return void
     */
    public function test_update_company() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $response = $this->putJson('/api/companies/' . $company_id, [
            'name' => 'Test Company 2',
            'parent_company_id' => null
        ]);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test delete a company.
     *
     * @return void
     */
    public function test_delete_company() {
        $company_response = $this->postJson('/api/companies', [
            'name' => 'Test Company',
            'parent_company_id' => null
        ]);

        $company_id = $company_response->json()['data']['id'];

        $response = $this->deleteJson('/api/companies/' . $company_id);

        $response->assertStatus(204);
    }
}
