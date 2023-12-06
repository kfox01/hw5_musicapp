// failedLogintest.php
<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class failedLogintest extends TestCase
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

    public function testPost_FailedLogin()
    {
        $response = $this->client->post('/login.php', [
            'form_params' => [
                'username' => 'wrongUsername', // Intentionally incorrect username
                'password' => 'wrongPassword', // Intentionally incorrect password
            ]
        ]);

        // Change the expected status code as per your application's behavior
        $this->assertEquals(201, $response->getStatusCode()); // or 200 if your app doesn't respond with 401
    }
}
