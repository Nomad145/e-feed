<?php

namespace Test;

use App\Feed;
use PHPUnit\Framework\TestCase;

/**
 * @author Michael Phillips <michael.phillips@realpage.com>
 */
class FeedTest extends TestCase
{
    private const ATOM_FEED = __DIR__ . '/fixtures/feed.atom';

    public function testGetEntries()
    {
        $subject = new Feed(file_get_contents(self::ATOM_FEED));

        $entries = $subject->getEntries();

        self::assertEquals(10, count($entries));
        self::assertSame($entries, $subject->getEntries());
    }
}
