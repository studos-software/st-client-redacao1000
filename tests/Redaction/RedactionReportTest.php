<?php
namespace Studos\Redacao1000\Tests\Redaction;

use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\Redaction\RedactionReport;
use Studos\Redacao1000\Tests\Base;

class RedactionReportTest extends Base
{
    /**
     * @test
     */
    public function reportFromRedactionId()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $service = new RedactionReport($this->client);
        $result = $service->redaction(1);

        $this->assertArrayHasKey('usuarioParceirold', $result['data']);
        $this->assertArrayHasKey('redacaold', $result['data']);
        $this->assertArrayHasKey('correcaoRedacaold', $result['data']);
        $this->assertArrayHasKey('redacaoTipo', $result['data']);
        $this->assertArrayHasKey('redacaoTexto', $result['data']);
        $this->assertArrayHasKey('redacaoEndlmagem', $result['data']);
        $this->assertArrayHasKey('temald', $result['data']);
        $this->assertArrayHasKey('temaTitulo', $result['data']);
        $this->assertArrayHasKey('genero', $result['data']);
        $this->assertArrayHasKey('situacao', $result['data']);
        $this->assertArrayHasKey('datEnvioCorrecao', $result['data']);
        $this->assertArrayHasKey('datCorrecao', $result['data']);
        $this->assertArrayHasKey('rankPlagium', $result['data']);
        $this->assertArrayHasKey('notaTotal', $result['data']);
        $this->assertArrayHasKey('comentario', $result['data']);
        $this->assertArrayHasKey('eixos', $result['data']);
        $this->assertArrayHasKey('comentarios', $result['data']);
        $this->assertArrayHasKey('codMotivoZero', $result['data']);
        $this->assertArrayHasKey('codMotivoZero', $result['data']);
        $this->assertArrayHasKey('motivoZero', $result['data']);
        $this->assertArrayHasKey('pageable', $result);
    }

    /**
     * @test
     */
    public function reportFromPeriod()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $starDate = $this->faker->dateTime;
        $endDate = $this->faker->dateTime;

        $service = new RedactionReport($this->client);
        $result = $service->period(1, $starDate, $endDate);

        $this->assertArrayHasKey('usuarioParceirold', $result['data']);
        $this->assertArrayHasKey('redacaold', $result['data']);
        $this->assertArrayHasKey('correcaoRedacaold', $result['data']);
        $this->assertArrayHasKey('redacaoTipo', $result['data']);
        $this->assertArrayHasKey('redacaoTexto', $result['data']);
        $this->assertArrayHasKey('redacaoEndlmagem', $result['data']);
        $this->assertArrayHasKey('temald', $result['data']);
        $this->assertArrayHasKey('temaTitulo', $result['data']);
        $this->assertArrayHasKey('genero', $result['data']);
        $this->assertArrayHasKey('situacao', $result['data']);
        $this->assertArrayHasKey('datEnvioCorrecao', $result['data']);
        $this->assertArrayHasKey('datCorrecao', $result['data']);
        $this->assertArrayHasKey('rankPlagium', $result['data']);
        $this->assertArrayHasKey('notaTotal', $result['data']);
        $this->assertArrayHasKey('comentario', $result['data']);
        $this->assertArrayHasKey('eixos', $result['data']);
        $this->assertArrayHasKey('comentarios', $result['data']);
        $this->assertArrayHasKey('codMotivoZero', $result['data']);
        $this->assertArrayHasKey('codMotivoZero', $result['data']);
        $this->assertArrayHasKey('motivoZero', $result['data']);
        $this->assertArrayHasKey('pageable', $result);
    }

    /**
     * @test
     */
    public function reportFromStudent()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $service = new RedactionReport($this->client);
        $result = $service->student(1, 10000008);

        $this->assertArrayHasKey('usuarioParceirold', $result['data']);
        $this->assertArrayHasKey('redacaold', $result['data']);
        $this->assertArrayHasKey('correcaoRedacaold', $result['data']);
        $this->assertArrayHasKey('redacaoTipo', $result['data']);
        $this->assertArrayHasKey('redacaoTexto', $result['data']);
        $this->assertArrayHasKey('redacaoEndlmagem', $result['data']);
        $this->assertArrayHasKey('temald', $result['data']);
        $this->assertArrayHasKey('temaTitulo', $result['data']);
        $this->assertArrayHasKey('genero', $result['data']);
        $this->assertArrayHasKey('situacao', $result['data']);
        $this->assertArrayHasKey('datEnvioCorrecao', $result['data']);
        $this->assertArrayHasKey('datCorrecao', $result['data']);
        $this->assertArrayHasKey('rankPlagium', $result['data']);
        $this->assertArrayHasKey('notaTotal', $result['data']);
        $this->assertArrayHasKey('comentario', $result['data']);
        $this->assertArrayHasKey('eixos', $result['data']);
        $this->assertArrayHasKey('comentarios', $result['data']);
        $this->assertArrayHasKey('codMotivoZero', $result['data']);
        $this->assertArrayHasKey('codMotivoZero', $result['data']);
        $this->assertArrayHasKey('motivoZero', $result['data']);
        $this->assertArrayHasKey('pageable', $result);
    }

    /**
     * @test
     */
    public function postBack()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $service = new RedactionReport($this->client);
        $result = $service->postBack();

        $this->assertArrayHasKey('data', $result);
    }
}
