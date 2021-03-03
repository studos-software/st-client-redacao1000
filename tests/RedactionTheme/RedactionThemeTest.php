<?php
namespace Studos\Redacao1000\Tests\Redaction;

use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\HttpClient;
use Studos\Redacao1000\RedactionTheme;
use Studos\Redacao1000\Tests\Base;

class RedactionThemeTest extends Base
{
    /**
     * @test
     * @dataProvider createRedactionThemeDataProvider
     */
    public function createRedactionTheme(
        string $title,
        int $category,
        int $genre,
        string $description,
        string $themeImage = null,
        bool $active = true,
        string $suggestion = null,
        string $teaserImage = null
    ): void {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];
        $this->client = $this->getClient($handlerStack);

        $params = func_get_args();
        $service = new RedactionTheme($this->client);
        $result = $service->signup(...$params);

        $this->assertArrayHasKey('id', $result['data']);
        $this->assertArrayHasKey('endImagem', $result['data']);
        $this->assertArrayHasKey('endImagemTeaser', $result['data']);
    }

    /**
     * @return \array[][]
     */
    public function createRedactionThemeDataProvider(): array
    {
        $faker = Factory::create();
        $image = realpath(__DIR__ . '/Requests/redacao-nota-mil.jpg');

        return [
            'fullData' => [
                $faker->title,
                1,
                1,
                $faker->text(100),
                $image,
                (bool) $faker->randomElement([true, false]),
                $faker->text(100),
                $image,
            ],
            'withoutOptionalParameters' => [
                $faker->title,
                1,
                1,
                $faker->text(100),
                $image,
            ],
        ];
    }
}
