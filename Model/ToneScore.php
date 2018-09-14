<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class ToneScore
 */
class ToneScore implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_SCORE = 'score';

    /**
     * @var string
     */
    const KEY_ID = 'tone_id';

    /**
     * @var string
     */
    const KEY_NAME = 'tone_name';

    /**
     * @var float
     */
    private $score;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @param float  $score
     * @param string $id
     * @param string $name
     */
    public function __construct($score, $id, $name)
    {
        $this->score = $score;
        $this->id    = $id;
        $this->name  = $name;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\ToneScore
     */
    public static function create(array $data)
    {
        return new self(
            $data[static::KEY_SCORE],
            $data[static::KEY_ID],
            $data[static::KEY_NAME]
        );
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
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
    public function getName()
    {
        return $this->name;
    }
}
