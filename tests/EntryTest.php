<?php

namespace Test;

use App\Entry;
use PHPUnit\Framework\TestCase;

/**
 * @author Michael Phillips <michael.phillips@realpage.com>
 */
class EntryTest extends TestCase
{
    public function testGetters()
    {
        $subject = new Entry([
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);

        self::assertEquals('Test Title', $subject->getTitle());
        self::assertEquals('Test Content', $subject->getContent());
    }
}
