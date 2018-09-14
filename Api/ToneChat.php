<?php

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\Utterance;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;

/**
 * Analyze customer engagement tone.
 *
 * Use the customer engagement endpoint to analyze the tone of customer service and customer support conversations.
 * For each utterance of a conversation, the method reports the most prevalent subset of the following seven tones:
 * sad, frustrated, satisfied, excited, polite, impolite, and sympathetic.
 *
 * If you submit more than 50 utterances, the service returns a warning for the overall content and analyzes only the
 * first 50 utterances. If you submit a single utterance that contains more than 500 characters, the service returns
 * an error for that utterance and does not analyze the utterance. The request fails if all utterances have more than
 * 500 characters.
 *
 * Per the JSON specification, the default character encoding for JSON content is effectively always UTF-8.
 */
class ToneChat extends AbstractApi
{
    /**
     * @var string
     */
    const ENDPOINT = '/tone_chat';

    /**
     * @return \IBM\Watson\Common\Api\AbstractApi|void
     */
    protected function setAllowedParams()
    {
        $this->allowedParams = [
            'utterances',
            'content_language',
            'accept_language'
        ];
    }

    /**
     * @param array $utterances
     * @param array $params
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis
     *
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function analyze(array $utterances, array $params = [])
    {
        $utterances = $this->validateUtterances($utterances);

        $params['utterances'] = $utterances;

        $response = $this->postRaw(self::ENDPOINT, json_encode($params), [
            'Content-Type' => 'application/json'
        ]);

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, UtteranceAnalyses::class);
    }

    /**
     * @param array $utterances
     *
     * @return array
     */
    private function validateUtterances(array $utterances)
    {
        $return = [];

        foreach ($utterances as $utterance) {
            $return[] = [
                Utterance::KEY_TEXT => $utterance instanceof Utterance ? $utterance->getText()
                    : $utterance[Utterance::KEY_TEXT],
                Utterance::KEY_USER => $utterance instanceof Utterance ? $utterance->getUser()
                    : $utterance[Utterance::KEY_USER]
            ];
        }

        return $return;
    }
}
