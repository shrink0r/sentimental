<?php

namespace Shrink0r\Sentimental\Tests\Feature;

use Shrink0r\Sentimental\Data\AnnotatedFile;
use Shrink0r\Sentimental\Data\DataSetInterface;

class AnnotatedFileTest extends \PHPUnit_Framework_TestCase
{
    const FIX_WEIGHT = 5;

    const FIX_CLASS = 'class1';

    const FIX_RECORD_CNT = 6;

    public function testGetters()
    {
        $filepath = __DIR__ . '/Fixture/annotated.txt';

        $dataset = new AnnotatedFile($filepath);
        $this->assertInstanceOf(DataSetInterface::CLASS, $dataset);
        $this->assertEquals(0, $dataset->getWeight());

        $dataset = new AnnotatedFile($filepath, self::FIX_WEIGHT);
        $this->assertInstanceOf(DataSetInterface::CLASS, $dataset);
        $this->assertEquals(self::FIX_WEIGHT, $dataset->getWeight());
    }

    public function testIterator()
    {
        $dataset = new AnnotatedFile(__DIR__ . '/Fixture/annotated.txt');
        $actual_count = 0;

        foreach ($dataset as $record) {
            $actual_count++;
            $this->assertTrue($record->isAnnotated());
        }
        $this->assertEquals(self::FIX_RECORD_CNT, $actual_count);
    }
}
