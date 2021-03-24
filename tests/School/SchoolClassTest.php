<?php
namespace Studos\Redacao1000\Tests\School;

use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\School\SchoolClass;
use Studos\Redacao1000\Tests\Base;

class SchoolClassTest extends Base
{
    /**
     * @test
     * @dataProvider subscribeClassDataProvider
     * @param string $year
     * @param string $codeSchool
     * @param string $codeClass
     * @param string $name
     */
    public function subscribeClass(string $year, string $codeSchool, string $codeClass, string $name)
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new SchoolClass($this->client);
        $result = $service->signup(
            $year,
            $codeSchool,
            $codeClass,
            $name
        );

        $this->assertArrayHasKey('turmaId', $result['data']);
    }

    /**
     * @test
     */
    public function subscribeClassWithInvalidCodeSchool()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new SchoolClass($this->client);
        $result = $service->signup(
            $this->faker->year,
            $this->faker->randomNumber(4),
            $this->faker->randomNumber(4),
            $this->faker->name
        );

        $this->assertArrayHasKey('error', $result);
    }

    /**
     * @return \array[][]
     */
    public function subscribeClassDataProvider(): array
    {
        $faker = Factory::create();

        return [
            'fullData' => [
                '1º ano',
                '1',
                (string) $faker->randomNumber(4),
                $faker->name,
            ],
        ];
    }
}
