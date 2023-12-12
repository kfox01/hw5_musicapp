<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class testPost_createUser extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(["base_uri" => "http://localhost:80/index.php"]);
    }

    public function testPost_CreateUser(): void
    {
        // Prepare the data for the POST request
        $postData = [
            'reg_username' => 'testUser',
            'reg_password' => 'testPassword',
            'c_password' => 'testPassword',
        ];

        // Mock the HTTP response
        $response = new Response(201);

        // Set up the Guzzle mock handler
        $mockHandler = new \GuzzleHttp\Handler\MockHandler([$response]);
        $handler = \GuzzleHttp\HandlerStack::create($mockHandler);
        $this->client = new Client(['handler' => $handler]);

        // Make the POST request
        $response = $this->client->request('POST', 'index.php/user/create', [
            'json' => $postData,
        ]);

        // Assert the response code is 201 (Created)
        $this->assertEquals(201, $response->getStatusCode());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}
