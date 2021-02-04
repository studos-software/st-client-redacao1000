<?php
namespace Studos\Redacao1000\Tests\Redaction;

use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\HttpClient;
use Studos\Redacao1000\Redaction;
use Studos\Redacao1000\Tests\Base;

class RedactionTest extends Base
{
    /**
     * @test
     * @dataProvider sendTextRedactionDataProvider
     * @param string $codeStudent
     * @param string $body
     * @param string $idTopic
     * @param string|null $mode
     * @param string|null $taskId
     */
    public function sendTextRedaction(
        string $codeStudent,
        string $body,
        string $idTopic,
        string $mode = Redaction::CORRECTION_MODE_ENEM2020,
        string $taskId = null
    )
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $service = new Redaction($this->client);
        $result = $service->text($codeStudent, $body, $idTopic, $mode, $taskId);

        $this->assertArrayHasKey('redacaoId', $result['data']);
        $this->assertArrayHasKey('correcaoRedacaoId', $result['data']);
    }

    /**
     * @test
     * @dataProvider sendImageRedactionDataProvider
     * @param string $codeStudent
     * @param string $image
     * @param string $idTopic
     * @param string|null $mode
     * @param string|null $taskId
     */
    public function sendImageRedaction(
        string $codeStudent,
        string $image,
        string $idTopic,
        string $mode = Redaction::CORRECTION_MODE_ENEM2020,
        string $taskId = null
    )
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $service = new Redaction($this->client);
        $result = $service->image($codeStudent, $image, $idTopic, $mode, $taskId);

        $this->assertArrayHasKey('redacaoId', $result['data']);
        $this->assertArrayHasKey('correcaoRedacaoId', $result['data']);
    }

    /**
     * @return \array[][]
     */
    public function sendTextRedactionDataProvider(): array
    {
        $faker = Factory::create();
        
        return [
            'fullData' => [
                (string) 10000008,
                $faker->text,
                (string) $faker->randomNumber(4),
                Redaction::CORRECTION_MODE_ENEM2020
            ],
            'taskId' => [
                (string) 10000008,
                $faker->text,
                '',
                Redaction::CORRECTION_MODE_ENEM2020,
                (string) $faker->randomNumber(4)
            ],
            'withoutOptionalParameters' => [
                (string) 10000008,
                $faker->text,
                (string) $faker->randomNumber(4),
            ],
            'urlPostBack' => [
                (string) 10000008,
                $faker->text,
                (string) $faker->randomNumber(4),
                Redaction::CORRECTION_MODE_ENEM2020,
                null,
                'http://localhost/hooks/',
            ],
        ];
    }

    /**
     * @return \array[][]
     */
    public function sendImageRedactionDataProvider(): array
    {
        $faker = Factory::create();
        $image = realpath(__DIR__ . '/Requests/redacao-nota-mil.jpg');

        return [
            'fullData' => [
                (string) 10000008,
                $image,
                (string) $faker->randomNumber(4),
                Redaction::CORRECTION_MODE_ENEM2020,
                (string) $faker->randomNumber(4)
            ],
            'withoutOptionalParameters' => [
                (string) 10000008,
                $image,
                (string) $faker->randomNumber(4),
            ],
        ];
    }
}
