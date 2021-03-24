<?php
namespace Studos\Redacao1000\Tests\Categories;

use GuzzleHttp\Psr7\Response;
use Studos\Redacao1000\Categories\Categories;
use Studos\Redacao1000\Tests\Base;

class CategoriesTest extends Base
{
    /**
     * @test
     */
    public function listCategories()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Categories($this->client);
        $result = $service->categories();

        $this->assertIsArray($result['data']);
    }

    /**
     * @test
     */
    public function listGenres()
    {
        $handleResponse = $this->fixture(__FUNCTION__, 'Responses');
        $handlerStack = [new Response(200, [], $handleResponse)];

        $this->client = $this->getClient($handlerStack);

        $service = new Categories($this->client);
        $result = $service->genres(1);

        $this->assertIsArray($result['data']);
    }
}
