<?php

namespace App;

/**
 * @author Michael Phillips <michael.phillips@realpage.com>
 */
class Entry
{
    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /**
     * @param array $entry
     */
    public function __construct(array $entry)
    {
        $this->title = $entry['title'];
        $this->content = $entry['content'];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
