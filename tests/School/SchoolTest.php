<?php
namespace Studos\Redacao1000\Tests\School;

use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\School;
use Studos\Redacao1000\Tests\Base;

class SchoolTest extends Base
{
    /**
     * @test
     * @dataProvider signupSchoolDataProvider
     * @param string $code
     * @param string $name
     * @param string $city
     * @param string $state
     * @param string|null $email
     * @param string|null $phoneNumber
     */
    public function signupSchool(
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

        $service = new School($this->client);
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
     * @return \array[][]
     */
    public function signupSchoolDataProvider(): array
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
