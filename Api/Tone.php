<?php

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Common\Api\AbstractApi;

/**
 * Analyze general tone.
 *
 * Use the general purpose endpoint to analyze the tone of your input content. The service analyzes the content for
 * emotional and language tones. The method always analyzes the tone of the full document; by default, it also
 * analyzes the tone of each individual sentence of the content.
 *
 * You can submit no more than 128 KB of total input content and no more than 1000 individual sentences in JSON, plain
 * text, or HTML format. The service analyzes the first 1000 sentences for document-level analysis and only the first
 * 100 sentences for sentence-level analysis.
 *
 * Per the JSON specification, the default character encoding for JSON content is effectively always UTF-8; per the
 * HTTP specification, the default encoding for plain text and HTML is ISO-8859-1 (effectively, the ASCII character
 * set). When specifying a content type of plain text or HTML, include the `charset` parameter to indicate the
 * character encoding of the input text; for example: `Content-Type: text/plain;charset=utf-8`. For `text/html`, the
 * service removes HTML tags and analyzes only the textual content.
 */
class Tone extends AbstractApi
{
    /**
     * @var string
     */
    const ENDPOINT = '/tone';

    /**
     * @var string
     */
    const CONTENT_TYPE_TEXT_PLAIN = 'text/plain';

    /**
     * @var string
     */
    const CONTENT_TYPE_HTML = 'text/html';

    /**
     * @var boolean
     */
    private $isHtml;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @param string $text
     * @param array  $params
     *
     * @return mixed
     *
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     */
    public function analyze($text, array $params = [])
    {
        $params['text'] = $text;

        $headers = [
            'Content-Type' => $this->getContentType()
        ];

        if (isset($params['content_language'])) {
            $headers['Content-Language'] = $params['content_language'];
            unset($params['content_language']);
        }

        if (isset($params['accept_language'])) {
            $headers['Accept-Language'] = $params['accept_language'];
            unset($params['accept_language']);
        }

        $response = $this->post(self::ENDPOINT, $params, $headers);

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response);
    }

    /**
     * Is supplied text html?
     *
     * @param bool $flag
     *
     * @return $this
     */
    public function isHtml($flag = false)
    {
        $this->isHtml = $flag;

        return $this;
    }

    /**
     * @return string
     */
    private function getContentType()
    {
        $this->isHtml ? $this->contentType = static::CONTENT_TYPE_HTML
            : $this->contentType = static::CONTENT_TYPE_TEXT_PLAIN;

        return $this->contentType;
    }
}
