<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class DocumentAnalysis
 */
class DocumentAnalysis implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_TONES = 'tones';

    /**
     * @var string
     */
    const KEY_WARNING = 'warning';

    /**
     * @var array
     */
    private $tones;

    /**
     * @var null
     */
    private $warning;

    /**
     * @param array       $tones
     * @param null|string $warning
     */
    public function __construct(array $tones = [], $warning = null)
    {
        $this->tones = $tones;
        $this->warning = $warning;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public static function create(array $data)
    {
        $tones = [];
        $warning = null;

        foreach ($data[static::KEY_TONES] as $tone) {
            $tones[] = ToneScore::create($tone);
        }

        if (isset($data[static::KEY_WARNING])) {
            $warning = $data[static::KEY_WARNING];
        }

        return new self(
            $tones,
            $warning
        );
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
    public function getWarning()
    {
        return $this->warning;
    }
}
