<?php

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;

class Tone extends AbstractApi
{
    /**
     * Analyze tone
     *
     * @param            $text
     * @param array|null $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \IBM\Watson\Common\Exception\UnknownErrorException
     * @throws \IBM\Watson\Common\Exception\NotFoundException
     * @throws \IBM\Watson\Common\Exception\InsufficientPrivilegesException
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\ToneAnalyzer\Exception
     * @throws \Exception
     */
    public function analyze($text, array $params = null)
    {
        $headers = [];

        if (!isset($params['version'])) {
            $params['version'] = \date('Y-m-d');
        }

        if (!isset($params['sentences'])) {
            $params['sentences'] = true;
        }

        if (isset($params['content_language'])) {
            $headers['Content-Language'] = $params['content_language'];
        }

        if (isset($params['accept_language'])) {
            $headers['Accept-Language'] = $params['accept_language'];
        }

        if (isset($params['learning_opt_out'])) {
            $headers['X-Watson-Learning-Opt-Out'] = true;
        }

        if (isset($params['is_html'])) {
            unset($params['is_html']);
            $response = $this->analyzeHtml($text, $params, $headers);
        } elseif (json_decode($text) && json_last_error() === JSON_ERROR_NONE) {
            $response = $this->analyzeJson($text, $params, $headers);
        } else {
            $response = $this->get('/api/v3/tone', $params, $headers);
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ToneAnalysis::class);
    }

    /**
     * Analyze HTML
     *
     * @param string $text
     * @param array  $params
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function analyzeHtml($text, array $params = [], array $headers = [])
    {
        $headers['Content-Type'] = 'text/html';

        return $this->post('/api/v3/tone' . '?' . http_build_query($params), ['text' => $text], $headers);
    }

    /**
     * Analyze JSON
     *
     * @param string $text
     * @param array  $params
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function analyzeJson($text, array $params = [], array $headers = [])
    {
        $headers['Content-Type'] = 'application/json';

        return $this->post('/api/v3/tone' . '?' . http_build_query($params), ['text' => $text], $headers);
    }
}
