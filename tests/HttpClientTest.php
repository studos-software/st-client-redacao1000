<?php
namespace Studos\Redacao1000\Tests\HttpClient;

use GuzzleHttp\ClientInterface;
use Studos\Redacao1000\HttpClient;
use Studos\Redacao1000\Tests\Base;

final class HttpClientTest extends Base
{
    /**
     * @test
     */
    public function constructorWithoutParameters()
    {
        $client = new HttpClient();

        $this->assertInstanceOf(ClientInterface::class, $client);
        $this->assertEquals(HttpClient::USER_AGENT, $client->headers['User-Agent']);
    }

    /**
     * @test
     */
    public function constructorWithToken()
    {
        $token = $this->faker->uuid;
        $client = new HttpClient($token);

        $this->assertInstanceOf(ClientInterface::class, $client);
        $this->assertEquals(HttpClient::USER_AGENT, $client->headers['User-Agent']);
    }

    /**
     * @test
     */
    public function constructorWithInvalidEnvironment()
    {
        $token = $this->faker->uuid;
        $environment = $this->faker->text(50);
        $client = new HttpClient($token, $environment);

        $this->assertInstanceOf(ClientInterface::class, $client);
        $this->assertEquals(HttpClient::USER_AGENT, $client->headers['User-Agent']);
    }

    /**
     * @test
     */
    public function constructorWithFullParams()
    {
        $token = $this->faker->uuid;
        $environment = $this->faker->randomElement([HttpClient::SANDBOX, HttpClient::PRODUCTION]);
        $client = new HttpClient($token, $environment);

        $this->assertInstanceOf(ClientInterface::class, $client);
        $this->assertEquals(HttpClient::USER_AGENT, $client->headers['User-Agent']);
    }
}
