<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class Sentence implements ApiResponseInterface
{
    /**
     * @var int
     */
    private $sentenceId;

    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $tones;

    /**
     * Sentence constructor.
     *
     * @param int    $sentenceId
     * @param string $text
     * @param array  $tones
     */
    public function __construct($sentenceId, $text, array $tones)
    {
        $this->sentenceId = $sentenceId;
        $this->text = $text;
        $this->tones = $tones;
    }

    /**
     * Create sentence
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\Sentence
     */
    public static function create(array $data)
    {
        $tones = [];

        foreach ($data['tones'] as $tone) {
            $tones[] = Tone::create($tone);
        }

        return new self($data['sentence_id'], $data['text'], $tones);
    }

    /**
     * Get sentence id
     *
     * @return int
     */
    public function getId()
    {
        return $this->sentenceId;
    }

    /**
     * Get sentence text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get sentence tones
     *
     * @return array
     */
    public function getTones()
    {
        return $this->tones;
    }
}
