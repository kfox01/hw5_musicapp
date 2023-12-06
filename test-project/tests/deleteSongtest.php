// deleteSongtest.php
<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class deleteSongtest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client([
            'base_uri' => 'http://localhost/', // Adjust this to your application's URI
            'http_errors' => false // To handle HTTP responses other than 200
        ]);
    }

    public function testPost_DeleteSong()
    {
        $songID = 3; // Replace with an existing song ID in your database

        $response = $this->client->post('/delete_song.php', [ // Adjust the endpoint as needed
            'form_params' => [
                'id' => $songID
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
