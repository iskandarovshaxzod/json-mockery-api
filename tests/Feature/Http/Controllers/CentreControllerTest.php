<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CentreControllerTest extends TestCase
{

    public function test_it_gets_all_centres()
    {
        $response = $this->getJson('api/centres');

        $response->assertOk();

        $this->assertGreaterThan(0,
            count($response->json()),
            'Expected at least one centre in the response');
    }

    public function test_it_gets_all_centres_with_name_query_that_exists()
    {
        $queryName = 'llc';

        $response = $this->getJson("api/centres?name=$queryName");

        $response->assertOk();

        $centres = $response->json();

        $this->assertGreaterThan(0,
            count($centres),
            'Expected at least one centre in the response');

        $random = $centres[array_rand($centres)];

        $this->assertStringContainsStringIgnoringCase($queryName, $random['name']);
    }

    public function test_it_gets_all_centres_with_name_query_that_doesnt_exist()
    {
        $queryName = 'llcfdfadfdsfasfasfd';

        $response = $this->getJson("api/centres?name=$queryName");

        $response->assertOk();

        $centres = $response->json();

        $this->assertSame(0,
            count($centres),
            'Expected 0 centre in the response');
    }

    public function test_it_gets_all_centres_with_only_limit_query()
    {
        $limit = 10;

        $response = $this->getJson("api/centres?limit=$limit");

        $response->assertOk();

        $this->assertSame($limit, count($response->json()));
    }

    public function test_it_gets_all_centres_with_pagination()
    {
        $offset = 10;
        $limit  = 10;

        $response = $this->getJson("api/centres?offset=$offset&limit=$limit");

        $response->assertOk();

        $this->assertSame($limit, count($response->json()));

        $this->assertSame($offset+1, $response->json()[0]['id']);
    }

    public function test_it_gets_a_centre_with_existing_id()
    {
        $response = $this->getJson("api/centres/1");

        $response->assertOk();

        $centre = $response->json();

        $this->assertSame(1, $centre['id']);
    }

    public function test_it_gets_a_centre_with_non_existing_id()
    {
        $response = $this->getJson("api/centres/111111");

        $response->assertNotFound();
    }

    public function test_it_posts_a_centre_without_checking_with_full_fields()
    {
        $centre = [
            'name' => 'Learning centre',
            'address' => 'Chicago, Michigan',
            'website' => 'hello.com',
            'phone_number' => '123 456 789'
        ];

        $response = $this->postJson('api/centres', $centre);

        $response->assertCreated();
    }

    public function test_it_posts_a_centre_without_checking_without_full_fields()
    {
        $centre = [
            'name' => 'Learning centre',
            'address' => 'Chicago, Michigan',
            'website' => 'hello.com',
//            'phone_number' => '123 456 789'
        ];

        $response = $this->postJson('api/centres', $centre);

        $response->assertCreated();
    }

    public function test_it_posts_a_centre_with_checking_with_full_fields()
    {
        $centre = [
            'name' => 'Learning centre',
            'address' => 'Chicago, Michigan',
            'website' => 'hello.com',
            'phone_number' => '123 456 789',
        ];

        $response = $this->postJson('api/centres?check=true', $centre);

        $response->assertCreated();
    }

    public function test_it_posts_a_centre_with_checking_without_full_fields()
    {
        $centre = [
            'name' => 'Learning centre',
            'address' => 'Chicago, Michigan',
            'website' => 'hello.com',
//            'phone_number' => '123 456 789'
        ];

        $response = $this->postJson('api/centres?check=true', $centre);

        $response->assertUnprocessable();
    }

    public function test_it_deletes_a_found_centre()
    {
        $response = $this->delete('api/centres/5');

        $response->assertNoContent();
    }

    public function test_it_tries_to_delete_a_not_found_centre()
    {
        $response = $this->delete('api/centres/5555');

        $response->assertNotFound();
    }
}
