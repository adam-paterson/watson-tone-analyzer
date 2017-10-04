<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class Utterance implements ApiResponseInterface
{
    /**
     * @var int
     */
    private $utteranceId;

    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $tones;

    /**
     * Utterance constructor.
     *
     * @param int       $utteranceId
     * @param string    $text
     * @param array     $tones
     */
    public function __construct($utteranceId, $text, array $tones)
    {
        $this->utteranceId = $utteranceId;
        $this->text = $text;
        $this->tones = $tones;
    }

    /**
     * Create individual utterance
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\Utterance
     */
    public static function create(array $data)
    {
        $tones = [];

        foreach ($data['tones'] as $tone) {
            $tones[] = Tone::create($tone);
        }

        return new self($data['utterance_id'], $data['utterance_text'], $tones);
    }

    /**
     * Get utterance id
     *
     * @return int
     */
    public function getId()
    {
        return $this->utteranceId;
    }

    /**
     * Get utterance text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get utterance tones
     *
     * @return array
     */
    public function getTones()
    {
        return $this->tones;
    }
}
