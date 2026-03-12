<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Set;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class SetApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_can_list_sets()
    {
        Set::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/sets');

        $response->assertStatus(200)
             ->assertJsonCount(5, 'data');    
    }

    public function test_can_create_set()
    {
    $data = [
        "name" => "Death Star",
        "theme" => "Star Wars",
        "year" => 2016,
        "num_parts" => 4016
    ];

    $response = $this->postJson('/api/v1/sets', $data);

    $response->assertStatus(201)
             ->assertJsonFragment([
                 "name" => "Death Star"
             ]);
    }
}
