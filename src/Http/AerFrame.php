<?php

namespace Mariohbrino\Aeris\Http;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Mariohbrino\Aeris\Http\Client\AerisClient;

class AerFrame extends AerisClient
{
    private $base_uri = 'https://api.aerframe.aeris.com';

    /**
     * AerFrame constructor.
     * @param string $url
     * @param string $apiKey
     */
    public function __construct(string $url, string $apiKey)
    {
        parent::__construct($this->base_uri, $url, $apiKey);
    }

    /**
     * @return Exception|ClientException|mixed
     */
    public function all()
    {
        return $this->show();
    }

    /**
     * @param array $playloads
     * @return Exception|ClientException|mixed
     */
    public function store(array $playloads)
    {
        return $this->post($playloads);
    }
}
