// updateSongtest.php
<?php

require_once 'vendor/autoload.php'; // Ensure all dependencies are loaded

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class updateSongtest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp(); // Call parent setup

        $this->client = new Client([
            'base_uri' => 'http://localhost/', // Replace with your application's HTTP address
            'timeout'  => 2.0,
        ]);
    }

    public function testPostUpdateSong()
    {
        $response = $this->client->post('/update_song.php', [
            'form_params' => [
                'song_id' => 5, // 
                'title' => 'New Song Title',
                'artist' => 'New Artist Name',
                'rating' => 4,
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
