<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class UtteranceAnalysis
 */
class UtteranceAnalysis implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_ID = 'utterance_id';

    /**
     * @var string
     */
    const KEY_TEXT = 'utterance_text';

    /**
     * @var string
     */
    const KEY_TONES = 'tones';

    /**
     * @var string
     */
    const KEY_ERROR = 'error';

    /**
     * @var integer
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
     * @var null|string
     */
    private $error;

    /**
     * @param integer     $id
     * @param string      $text
     * @param array       $tones
     * @param null|string $error
     */
    public function __construct($id, $text, array $tones, $error = null)
    {
        $this->id    = $id;
        $this->text  = $text;
        $this->tones = $tones;
        $this->error = $error;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis
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
            $tones,
            isset($data[static::KEY_ERROR]) ?: null
        );
    }

    /**
     * @return integer
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

    /**
     * @return null|string
     */
    public function getError()
    {
        return $this->error;
    }
}
