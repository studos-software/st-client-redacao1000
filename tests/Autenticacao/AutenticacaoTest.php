<?php
namespace Studos\Redacao1000\Tests\Autenticacao;

use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\Autenticacao;
use Studos\Redacao1000\Tests\Base;

class AutenticacaoTest extends Base
{
    /**
     * @test
     */
    public function loginWithValidCredentialsMustReturnJwtTokenWithValidation()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Autenticacao($this->client);
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

        $service = new Autenticacao($this->client);
        $result = $service->login($this->faker->email, $this->faker->password);

        $this->assertArrayHasKey('error', $result);
    }
}
