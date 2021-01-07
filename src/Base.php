<?php
namespace Studos\Redacao1000;

use Error;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

abstract class Base
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Do an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @return mixed
     */
    protected function request(string $method, string $uri, array $parameters = [])
    {
        try {
            $response = $this->client->request($method, $uri, ['body' => json_encode($parameters)]);

            $json = $response->getBody()->getContents();
        } catch (ClientException|Error|GuzzleException $error) {
            $json = $error->getResponse()->getBody()->getContents();
        }

        $jsonConverted = mb_convert_encoding($json, "UTF-8");

        return json_decode($jsonConverted, true);
    }
}
