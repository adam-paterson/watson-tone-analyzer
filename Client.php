<?php

namespace IBM\Watson\ToneAnalyzer;

use IBM\Watson\Common\AbstractClient;
use IBM\Watson\Common\HttpClient\Builder;

/**
 * Tone Analyzer service
 */
class Client extends AbstractClient
{
    /**
     * @var array
     */
    protected static $locationEndpoints = [
        'us_south' => 'https://gateway.watsonplatform.net/tone-analyzer/api',
        'us_east' => 'https://gateway-wdc.watsonplatform.net/tone-analyzer/api',
        'germany' => 'https://gateway-fra.watsonplatform.net/tone-analyzer/api',
        'sydney' => 'https://gateway-syd.watsonplatform.net/tone-analyzer/api',
        'uk' => 'https://gateway.watsonplatform.net/tone-analyzer/api'
    ];

    /**
     * Create new configured client with username and password
     *
     * @param string $username
     * @param string $password
     *
     * @param string $version
     * @param string $location
     *
     * @return \IBM\Watson\ToneAnalyzer\Client
     *
     * @throws \Exception
     */
    public static function create($username, $password, $version = null, $location = 'us_south')
    {
        $httpClient = (new Builder())
            ->withCredentials($username, $password)
            ->withVersion($version)
            ->withHost(static::$locationEndpoints[$location])
            ->createConfiguredClient();

        return new self($httpClient);
    }

    /**
     * @return \IBM\Watson\ToneAnalyzer\Api\Tone
     */
    public function tone()
    {
        return new Api\Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    /**
     * @return \IBM\Watson\ToneAnalyzer\Api\ToneChat
     */
    public function toneChat()
    {
        return new Api\ToneChat($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
