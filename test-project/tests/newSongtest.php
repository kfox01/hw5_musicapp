// YourTestClassName.php
<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class newSongtest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client([
            'base_uri' => 'http://localhost/yourapp', // Adjust this to your application's URI
            'http_errors' => false // To handle HTTP responses other than 200
        ]);
    }

    public function testPost_NewSong()
    {
        $response = $this->client->post('/path/to/your/song/creation/script.php', [
            'form_params' => [
                'username' => 'testuser', // Replace with actual data
                'password' => 'testpassword', // Replace with actual data
                'title' => 'New Test Song',
                'artist' => 'Test Artist',
                'rating' => 5,
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }
}
