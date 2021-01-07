<?php
namespace Studos\Redacao1000\Tests\Escola;

use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\Escola;
use Studos\Redacao1000\HttpClient;
use Studos\Redacao1000\Tests\Base;

class EscolaTest extends Base
{
    /**
     * @test
     * @dataProvider subscribeSchoolDataProvider
     * @param string $code
     * @param string $name
     * @param string $city
     * @param string $state
     * @param string|null $email
     * @param string|null $phoneNumber
     */
    public function subscribeSchool(
        string $code,
        string $name,
        string $city,
        string $state,
        string $email = null,
        string $phoneNumber = null
    )
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Escola($this->client);
        $result = $service->signup(
            $code,
            $name,
            $city,
            $state,
            $email,
            $phoneNumber
        );

        $this->assertArrayHasKey('escolaId', $result['data']);
    }

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

        $service = new Escola($this->client);
        $result = $service->signupClass(
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

        $service = new Escola($this->client);
        $result = $service->signupClass(
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

    /**
     * @return \array[][]
     */
    public function subscribeSchoolDataProvider(): array
    {
        $faker = Factory::create();
        
        return [
            'fullData' => [
                (string) $faker->randomNumber(4),
                $faker->name,
                $faker->city,
                $faker->randomElement(explode(',', 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO')),
                $faker->email,
                $faker->phoneNumber,
            ],
            'withoutEmail' => [
                (string) $faker->randomNumber(4),
                $faker->name,
                $faker->city,
                $faker->randomElement(explode(',', 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO')),
                null,
                $faker->phoneNumber,
            ],
            'withoutPhone' => [
                (string) $faker->randomNumber(4),
                $faker->name,
                $faker->city,
                $faker->randomElement(explode(',', 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO')),
                $faker->email,
                null,
            ],
            'withoutEmailAndPhone' => [
                (string) $faker->randomNumber(4),
                $faker->name,
                $faker->city,
                $faker->randomElement(explode(',', 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO')),
            ],
            'invalidEmail' => [
                (string) $faker->randomNumber(4),
                $faker->name,
                $faker->city,
                $faker->randomElement(explode(',', 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO')),
                $faker->text(100),
                $faker->phoneNumber,
            ],
        ];
    }
}
