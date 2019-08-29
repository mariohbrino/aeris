<?php

namespace Mariohbrino\Aeris\AerFrame;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Mariohbrino\Aeris\Http\AerFrame;

class SendMessage extends AerFrame
{
    /**
     * Message constructor.
     * @param string $apiKey
     * @param string $accountId
     * @param string $shortAppName
     */
    public function __construct(string $apiKey, string $accountId, string $shortAppName)
    {
        $url = "smsmessaging/v2/{$accountId}/outbound/{$shortAppName}/requests";

        parent::__construct($url, $apiKey);
    }

    /**
     * Send one MT SMS to device.
     * @param array $data
     * @return Exception|ClientException|mixed
     */
    public function sendMtSms(array $data = [])
    {
        $playloads = [
            'address' => [
                $data['destination']
            ],
            "senderAddress" => $data['origin'],
            'outboundSMSTextMessage' => [
                'message' => $data['message']
            ],
            'clientCorrelator' => $data['correlator'],
            'senderName' => $data['sender_name']
        ];

        return $this->post($playloads);
    }
}
