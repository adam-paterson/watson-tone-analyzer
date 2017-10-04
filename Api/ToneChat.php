<?php

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;

class ToneChat extends AbstractApi
{
    /**
     * Analyze tone chat
     *
     * @param string    $text
     * @param array     $params
     *
     * @return mixed
     */
    public function analyze($text, array $params = [])
    {
        $headers = ['Content-Type' => 'application/json'];

        if (!isset($params['version'])) {
            $params['version'] = \date('Y-m-d');
        }

        $response = $this->postRaw('/api/v3/tone_chat' . '?' . http_build_query($params), $text, $headers);

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, UtteranceAnalyses::class);
    }
}
