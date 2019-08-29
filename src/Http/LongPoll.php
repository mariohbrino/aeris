<?php

namespace Mariohbrino\Aeris\Http;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Mariohbrino\Aeris\Http\Client\AerisClient;

class LongPoll extends AerisClient
{
    private $base_uri = 'https://longpoll.aerframe.aeris.com';

    /**
     * LongPoll constructor.
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
}
