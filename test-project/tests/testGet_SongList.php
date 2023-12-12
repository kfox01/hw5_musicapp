<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class testGet_SongList extends TestCase
{
  protected $client;

  protected function setUp(): void
  {
    parent::setUp();
    $this->client = new Client(["base_uri" => "http://localhost:80/index.php"]); // Update the base URI accordingly
  }

  public function testGet_SongList()
  {
    $response = $this->client->request('GET', '/index.php/song/list');

    $statusCode = $response->getStatusCode();
    $responseData = json_decode($response->getBody(), true);

    // Assert that the status code is 200 for a successful request
    $this->assertEquals(200, $statusCode);

    // Assert that the response contains a 'status' key with the value 'success'
    $this->assertArrayHasKey('status', $responseData);
    $this->assertEquals('success', $responseData['status']);

    // Assert that the response contains a 'songs' key, as it's expected to be a list of songs
    $this->assertArrayHasKey('songs', $responseData);
  }

  public function tearDown(): void
  {
    parent::tearDown();
    $this->client = null;
  }
}
