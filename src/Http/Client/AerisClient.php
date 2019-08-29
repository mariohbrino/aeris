<?php

namespace Mariohbrino\Aeris\Http\Client;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class AerisClient
{
    private $base_uri = '';
    private $url = '';

    protected $client;


    /**
     * HttpRequest constructor.
     * @param string $baseUri
     * @param string $apiKey
     */
    public function __construct(string $baseUri, string $url, string $apiKey)
    {
        $this->base_uri = $baseUri;
        $this->url = $url;

        $this->client = new GuzzleClient([
            'base_uri' => $this->base_uri,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accepts' => 'application/json'
            ],
            'query' => ['apiKey' => $apiKey]
        ]);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->$name;
    }

    /**
     * @return Exception|ClientException|mixed
     */
    protected function show()
    {
        return self::submit('GET');
    }

    /**
     * @param array $playload
     * @return Exception|ClientException|mixed
     */
    protected function post(array $playload)
    {
        return self::submit(
            'POST',
            ['body' => json_encode($playload, true)]
        );
    }

    /**
     * @return Exception|ClientException|mixed
     */
    protected function delete()
    {
        return self::submit('DELETE');
    }

    /**
     * @param array $request
     * @return Exception|ClientException|mixed
     */
    protected function getParameters(array $request)
    {
        return self::submit(
            'GET',
            ['query' => array_merge($request, ['apiKey' => $this->apiKey])]
        );
    }

    /**
     * @param string $method
     * @param array $params
     * @return Exception|ClientException|mixed
     */
    private function submit(string $method = 'GET', array $params = [])
    {
        try {
            $response = $this->client->request($method, $this->url, $params);
        } catch (ClientException $exception) {
            return [
                'code' => json_encode($exception->getCode(), true),
                'request' => json_encode($exception->getRequest(), true),
                'response' => json_encode($exception->getResponse(), true),
                'message' => json_encode($exception->getMessage(), true),
                'reason_phrase' => json_encode($exception->getResponse()->getReasonPhrase(), true),
                'contents' => json_encode($exception->getResponse()->getBody()->getContents(), true)
            ];
        } catch (GuzzleException $exception) {
            return json_encode($exception->getMessage());
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
