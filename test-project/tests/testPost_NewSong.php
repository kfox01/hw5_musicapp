<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class testPost_NewSong extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(["base_uri" => "http://localhost:80"]); // Update the base URI accordingly
    }

    public function testPost_NewSong()
    {
        // Hardcoded song data for testing
        $newSongData = [
            'user' => 'newuser', // Replace with a valid username in your database
            'title' => 'New Song',
            'artist' => 'New Artist',
            'rating' => 5,
            // Add other fields as necessary for your application
        ];

        $response = $this->client->request('POST', '/index.php/song/create', [
            'json' => $newSongData,
        ]); // Update the endpoint accordingly

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        // Assert that the status code is 201 for a successful creation
        $this->assertEquals(201, $statusCode);

        // Assert that the response contains a 'message' key with the value 'Song added successfully'
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Song added successfully', $responseData['message']);

        // Assert that the response contains a 'song_id' key
        $this->assertArrayHasKey('song_id', $responseData);
        // Optionally, you can further assert specific values or format of the response
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}
