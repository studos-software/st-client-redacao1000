<?php
namespace Studos\Redacao1000\Tests\Student;

use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\Student\Student;
use Studos\Redacao1000\Tests\Base;

class StudentTest extends Base
{
    /**
     * @test
     * @dataProvider signupStudentDataProvider
     * @param string $codeStudent
     * @param string $codeSchool
     * @param string $codeRegistration
     * @param string $codeSchoolClass
     * @param string $email
     * @param string $name
     * @param int|null $taskId
     * @param bool $generateAccessToken
     */
    public function signupStudent(
        string $codeStudent,
        string $codeSchool,
        string $codeRegistration,
        string $codeSchoolClass,
        string $email,
        string $name,
        int $taskId = null,
        bool $generateAccessToken = false
    ) {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Student($this->client);
        $result = $service->signup(
            $codeStudent,
            $codeSchool,
            $codeRegistration,
            $codeSchoolClass,
            $email,
            $name,
            $taskId,
            $generateAccessToken
        );

        $this->assertArrayHasKey('alunoId', $result['data']);
    }

    /**
     * @return \array[][]
     */
    public function signupStudentDataProvider(): array
    {
        $faker = Factory::create();
        
        return [
            'fullData' => [
                (string) $faker->randomNumber(4),
                (string) $faker->randomNumber(4),
                (string) $faker->randomNumber(4),
                (string) $faker->randomNumber(4),
                $faker->email,
                $faker->name,
                $faker->randomNumber(4),
                true
            ],
            'withoutOptionalParameters' => [
                (string) $faker->randomNumber(4),
                (string) $faker->randomNumber(4),
                (string) $faker->randomNumber(4),
                (string) $faker->randomNumber(4),
                $faker->email,
                $faker->name
            ],
        ];
    }
}
