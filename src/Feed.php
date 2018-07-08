<?php

namespace App;

use SimpleXmlElement;

/**
 * @author Michael Phillips <michael.phillips@realpage.com>
 */
class Feed
{
    /** @var SimpleXmlElement */
    private $feed;

    /** @var Entry[] */
    private $entries = [];

    public function __construct(string $feed)
    {
        $this->feed = new SimpleXmlElement($feed);
    }

    public function getTitle(): string
    {
        return $this->feed->id;
    }

    public function getEntries()
    {
        if (!empty($this->entries)) {
            return $this->entries;
        }

        foreach ($this->feed->entry as $entry) {
            $this->entries[] = new Entry((array) $entry);
        }

        return $this->entries;
    }

    public function findEntryByName(string $name): ?Entry
    {
        $entry = array_filter(
            $this->getEntries(),
            function (Entry $entry) use ($name) {
                return $entry->getTitle() === $name;
            }
        );

        return array_pop($entry);
    }
}
