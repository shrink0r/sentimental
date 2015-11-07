<?php

namespace Shrink0r\Sentimental\Tests\Feature;

use Shrink0r\Sentimental\Data\Record;

class RecordTest extends \PHPUnit_Framework_TestCase
{
    const FIX_CONTENT = 'Hello world!';

    const FIX_CLASS = 'class1';

    public function testCreate()
    {
        $record = new Record(self::FIX_CONTENT);

        $this->assertFalse($record->isAnnotated());
        $this->assertEquals(self::FIX_CONTENT, $record->getContent());
    }

    public function testCreateAnnotated()
    {
        $record = new Record(self::FIX_CONTENT, self::FIX_CLASS);

        $this->assertTrue($record->isAnnotated());
        $this->assertEquals(self::FIX_CONTENT, $record->getContent());
        $this->assertEquals(self::FIX_CLASS, $record->getClass());
    }
}
