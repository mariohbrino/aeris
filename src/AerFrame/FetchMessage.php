<?php

namespace Mariohbrino\Aeris\AerFrame;

use Mariohbrino\Aeris\Http\LongPoll;

class FetchMessage extends LongPoll
{
    /**
     * FetchMessage constructor.
     * @param string $apiKey
     * @param string $accountId
     * @param string $channelId
     */
    public function __construct(string $apiKey, string $accountId, string $channelId)
    {
        $url = "notificationchannel/v2/{$accountId}/longpoll/{$channelId}";

        parent::__construct($url, $apiKey);
    }
}
