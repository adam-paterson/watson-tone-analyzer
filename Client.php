<?php

namespace IBM\Watson\ToneAnalyzer;

use IBM\Watson\Common\AbstractClient;
use IBM\Watson\Common\HttpClient\Builder;

final class Client extends AbstractClient
{
    /**
     * Base tone analyzer uri
     */
    const BASE_URI = 'https://gateway.watsonplatform.net/tone-analyzer';

    /**
     * Create tone analyzer client with username and password
     *
     * @param string $username
     * @param string $password
     *
     * @return \IBM\Watson\ToneAnalyzer\Client
     *
     * @throws \Http\Discovery\Exception\NotFoundException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public static function create($username, $password)
    {
        $httpClient = (new Builder())
            ->withEndpoint(static::BASE_URI)
            ->withCredentials($username, $password)
            ->createConfiguredClient();

        return new self($httpClient);
    }

    /**
     * Create tone api request
     *
     * @return \IBM\Watson\ToneAnalyzer\Api\Tone
     */
    public function tone()
    {
        return new Api\Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    /**
     * Create tone chat api request
     *
     * @return \IBM\Watson\ToneAnalyzer\Api\ToneChat
     */
    public function toneChat()
    {
        return new Api\ToneChat($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
