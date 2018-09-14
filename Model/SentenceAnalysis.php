<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class SentenceAnalysis
 */
class SentenceAnalysis implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_ID = 'sentence_id';

    /**
     * @var string
     */
    const KEY_TEXT = 'text';

    /**
     * @var string
     */
    const KEY_TONES = 'tones';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $tones;

    /**
     * @param string $id
     * @param string $text
     * @param array  $tones
     */
    public function __construct($id, $text, array $tones = [])
    {
        $this->id    = $id;
        $this->text  = $text;
        $this->tones = $tones;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis
     */
    public static function create(array $data)
    {
        $tones = [];

        foreach ($data[static::KEY_TONES] as $tone) {
            $tones[] = ToneScore::create($tone);
        }

        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_TEXT],
            $tones
        );
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return array
     */
    public function getTones()
    {
        return $this->tones;
    }
}
