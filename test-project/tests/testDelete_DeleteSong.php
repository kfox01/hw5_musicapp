<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class testDelete_DeleteSong extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(["base_uri" => "http://localhost:80"]); // Update the base URI accordingly
    }

    public function testDelete_DeleteSong()
    {
        $songData = [
            'id' => 1,
            'artist' => 'Test Artist',
            'song_name' => 'Test Song',
            'rating' => 5,
            'username' => 'test_user',
            'password' => 'test_password',
        ];

        $response = $this->client->request('DELETE', '/index.php/song/delete', [
            'json' => $songData,
        ]); // Update the endpoint accordingly

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        // Assert that the status code is 200 for a successful request
        $this->assertEquals(200, $statusCode);

        // Assert that the response contains a 'message' key with the value 'Song deleted successfully'
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Song deleted successfully', $responseData['message']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}
