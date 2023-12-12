<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class testPost_FailedLogin extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(["base_uri" => "http://localhost:80/index.php"]);
    }

    public function testPost_FailedLogin()
    {
        $nonExistentUsername = 'nonexistentuser';
        $wrongPassword = 'wrongpassword';

        $response = $this->client->request('POST', '/index.php/user/login', [
            'json' => [
                'log_username' => $nonExistentUsername,
                'log_password' => $wrongPassword,
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        // Assert that the status code is 401 for failed login
        $this->assertEquals(401, $statusCode);

        // Assert that the response contains a specific error message
        $this->assertArrayHasKey('error', $responseData);
        $this->assertEquals('invalid username', $responseData['error']);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('username already exist in database', $responseData['message']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
}
