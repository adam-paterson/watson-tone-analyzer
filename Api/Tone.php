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

        $params['text'] = $text;

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

        $response = $this->get('/api/v3/tone', $params, $headers);

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ToneAnalysis::class);
    }
}
