<?php
namespace Studos\Redacao1000\Tests\Authentication;

use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\Authentication;
use Studos\Redacao1000\Tests\Base;

class AuthenticationTest extends Base
{
    /**
     * @test
     */
    public function loginWithValidCredentialsMustReturnJwtTokenWithValidation()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Authentication($this->client);
        $result = $service->login($this->faker->email, $this->faker->password);

        $this->assertArrayHasKey('jwtToken', $result['data']);
        $this->assertArrayHasKey('nome', $result['data']);
        $this->assertArrayHasKey('validadeToken', $result['data']);
    }

    /**
     * @test
     */
    public function loginWithInvalidCredentialsMustReturnError()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(401, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Authentication($this->client);
        $result = $service->login($this->faker->email, $this->faker->password);

        $this->assertArrayHasKey('error', $result);
    }
}
