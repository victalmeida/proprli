<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * Test to test Missging Params to Auth
     */
    public function test_missing_params_on_auth(): void
    {
        $response = $this->post('api/auth')
            ->assertUnprocessable();

        $this->assertEquals(
            'Validation errors',
            $response->json()['message']
        );

        $this->assertEquals(
            2,
            count($response->json()['data'])
        );
    }

    /**
     * Test to test wrong Params to Auth  
     */
    public function test_wrong_credentials_on_auth(): void
    {
        $response = $this->post(
            'api/auth',
            [
                "email" => "teste@teste.com",
                "password" => "wrong_pass"
            ]
        )
            ->assertUnauthorized();

        $this->assertEquals(
            'error',
            $response->json()['status']
        );

        $this->assertEquals(
            "Unauthorized",
            $response->json()['message']
        );
    }

    /**
     * Test to test Login and Json
     *
     * @return void
     */
    public function test_right_credentials_on_auth(): void
    {
        $response = $this->postJson(
            'api/auth',
            [
                "email" => "berniece.jones@example.net",
                "password" => "password"
            ]
        )->assertOk();

        $this->assertEquals(
            'success',
            $response->json()['status']
        );
        $this->assertArrayHasKey('token', $response->json());
    }
}
