<?php

namespace IBM\Watson\ToneAnalyzer;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use IBM\Watson\Common\HttpClient\Builder;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\RequestBuilder;

final class Client
{
    /**
     * Base tone analyzer uri
     */
    const BASE_URI = 'https://gateway.watsonplatform.net/tone-analyzer';

    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var \IBM\Watson\Common\Hydrator\ModelHydrator
     */
    private $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    private $requestBuilder;

    /**
     * Client constructor.
     *
     * @param \Http\Client\HttpClient|null                       $httpClient
     * @param \IBM\Watson\Common\Hydrator\HydratorInterface|null $hydrator
     * @param \IBM\Watson\Common\RequestBuilder|null             $requestBuilder
     *
     * @throws \Http\Discovery\Exception\NotFoundException
     */
    public function __construct(
        HttpClient $httpClient = null,
        HydratorInterface $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->hydrator = $hydrator ?: new ModelHydrator;
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder;
    }

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
