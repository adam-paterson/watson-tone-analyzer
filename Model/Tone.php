<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class Tone implements ApiResponseInterface
{
    /**
     * @var string
     */
    private $toneId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var double
     */
    private $score;

    /**
     * Tone constructor.
     *
     * @param string $toneId
     * @param string $name
     * @param double $score
     */
    public function __construct($toneId, $name, $score)
    {
        $this->toneId = $toneId;
        $this->name = $name;
        $this->score = $score;
    }

    /**
     * Create tone
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\Tone
     */
    public static function create(array $data)
    {
        return new self($data['tone_id'], $data['tone_name'], $data['score']);
    }

    /**
     * Get tone id
     *
     * @return string
     */
    public function getId()
    {
        return $this->toneId;
    }

    /**
     * Get tone name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get tone score
     *
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }
}
