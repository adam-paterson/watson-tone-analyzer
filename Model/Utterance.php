<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Class Utterance
 */
class Utterance implements CreateableFromArray
{
    /**
     * @var string
     */
    const KEY_TEXT = 'text';

    /**
     * @var string
     */
    const KEY_USER = 'user';

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $user;

    /**
     * @param string $text
     * @param string $user
     */
    public function __construct($text, $user)
    {
        $this->text = $text;
        $this->user = $user;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\Engagement\Utterance
     */
    public static function create(array $data)
    {
        return new self($data[static::KEY_TEXT], $data[static::KEY_USER]);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
}
