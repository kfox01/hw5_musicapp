<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class testPost_UpdateSong extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(["base_uri" => "http://localhost:80"]); // Update the base URI accordingly
    }

    public function testPost_UpdateSong()
    {
        // Hardcoded song data for testing
        $songData = [
            'id' => 1, // Replace with an existing song ID in your database
            'title' => 'Updated Title',
            'artist' => 'Updated Artist',
            'rating' => 4,
            // Add other fields as necessary for your application
        ];

        $response = $this->client->request('PUT', '/index.php/song/edit', [
            'json' => $songData,
        ]); // Update the endpoint accordingly

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        // Assert that the status code is 200 for a successful request
        $this->assertEquals(200, $statusCode);

        // Assert that the response contains a 'message' key with the value 'Song updated successfully'
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Song updated successfully', $responseData['message']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}
