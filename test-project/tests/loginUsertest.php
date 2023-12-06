// loginUsertest.php
<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class loginUsertest extends TestCase
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

    public function testPost_LoginUser()
    {
        $response = $this->client->post('/login.php', [ // Adjust the endpoint as needed
            'form_params' => [
                'username' => 'existingUser', // Use an existing username
                'password' => 'correctPassword', // Use the correct password
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode()); // Assuming 201 is the expected response
    }
}
