// createUsertest.php
<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class createUsertest extends TestCase
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

    public function testPost_CreateUser()
    {
        $response = $this->client->post('/registration.php', [ // Adjust the endpoint as needed
            'form_params' => [
                'username' => 'newUser', // Use a new username
                'password' => 'newPassword', // Use a new password
                'confirm_password' => 'newPassword' // Confirm the new password
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode()); // Assuming 201 is the expected response
    }
}
