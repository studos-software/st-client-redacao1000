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
    protected ClientInterface $client;

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
            $jsonConverted = mb_convert_encoding($json, "UTF-8");

            return json_decode($jsonConverted, true);
        } catch (ClientException|Error|GuzzleException $error) {
            $this->throwsError($error);

            return false;
        }
    }

    /**
     * Upload file(s).
     *
     * @param string $uri
     * @param array $parameters
     * @return mixed
     */
    protected function upload(string $uri, array $parameters = [])
    {
        try {
            $response = $this->client->request('POST', $uri, ['multipart' => $parameters]);

            $json = $response->getBody()->getContents();
            $jsonConverted = mb_convert_encoding($json, "UTF-8");

            return json_decode($jsonConverted, true);
        } catch (ClientException|Error|GuzzleException $error) {
            $this->throwsError($error);

            return false;
        }
    }

    /**
     * Throws error exception
     * @param $error
     */
    private function throwsError($error)
    {
        $json = $error->getResponse()->getBody()->getContents();
        $jsonConverted = mb_convert_encoding($json, "UTF-8");
        $result =  json_decode($jsonConverted, true);
        $message = $result['error']['message'] ?? $result['error']['status'];
        $exceptionClass = get_called_class() . 'Exception';

        throw new $exceptionClass($message, $error->getCode());
    }
}
