<?php


namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class UtteranceAnalyses
 */
class UtteranceAnalyses implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_TONE = 'utterances_tone';

    /**
     * @var string
     */
    const KEY_WARNING = 'warning';

    /**
     * @var array
     */
    private $tones;

    /**
     * @var null|string
     */
    private $warning;

    /**
     * @param array       $tones
     * @param null|string $warning
     */
    public function __construct(array $tones, $warning = null)
    {
        $this->tones    = $tones;
        $this->warning = $warning;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses
     */
    public static function create(array $data)
    {
        $tones = [];
        foreach ($data[static::KEY_TONE] as $tone) {
            $tones[] = UtteranceAnalysis::create($tone);
        }

        return new self($tones, isset($data[static::KEY_WARNING]) ? $data[static::KEY_WARNING] : null);
    }

    /**
     * @return array
     */
    public function getTones()
    {
        return $this->tones;
    }

    /**
     * @return null
     */
    public function getWarning()
    {
        return $this->warning;
    }
}
