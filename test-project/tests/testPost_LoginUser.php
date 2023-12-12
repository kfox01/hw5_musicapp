<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class testPost_LoginUser extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(["base_uri" => "http://localhost:80/index.php"]);
    }

    public function testPost_LoginUser(): void
    {
        // Hardcoded existing username and password
        $existingUsername = 'omizz';
        $existingPassword = '123';

        // Make a POST request to simulate user login
        $response = $this->client->request('POST', '/index.php/user/login', [
            'json' => [
                'log_username' => $existingUsername,
                'log_password' => $existingPassword,
            ],
        ]);

        // Assert that the response code is 200 (OK) for successful login
        $this->assertEquals(200, $response->getStatusCode());

        // Optionally, you can assert other details about the response
        $responseData = json_decode($response->getBody(), true);
        $this->assertEquals('success', $responseData['status']);
        $this->assertEquals($existingUsername, $responseData['username']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}
