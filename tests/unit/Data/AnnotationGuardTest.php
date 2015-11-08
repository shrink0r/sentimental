<?php

namespace Shrink0r\Sentimental\Tests\Feature;

use Shrink0r\Sentimental\Data\AnnotationGuard;
use Shrink0r\Sentimental\Data\DataSetInterface;
use Shrink0r\Sentimental\Data\DictionaryInclude;
use Shrink0r\Sentimental\Data\Document;

class AnnotationGuardTest extends \PHPUnit_Framework_TestCase
{
    const FIX_WEIGHT = 5;

    const FIX_CLASS = 'class1';

    const FIX_RECORD_CNT = 15;

    public function testGetters()
    {
        $dictionary_path = __DIR__ . '/Fixture/dictionary.php';

        $dataset = new AnnotationGuard(new DictionaryInclude($dictionary_path, self::FIX_CLASS));
        $this->assertInstanceOf(DataSetInterface::CLASS, $dataset);
        $this->assertEquals(0, $dataset->getWeight());

        $dataset = new AnnotationGuard(
            new DictionaryInclude($dictionary_path, self::FIX_CLASS, self::FIX_WEIGHT)
        );
        $this->assertInstanceOf(DataSetInterface::CLASS, $dataset);
        $this->assertEquals(self::FIX_WEIGHT, $dataset->getWeight());
    }

    public function testIterator()
    {
        $dataset = new AnnotationGuard(new DictionaryInclude(__DIR__ . '/Fixture/dictionary.php', self::FIX_CLASS));
        $actual_count = 0;

        foreach ($dataset as $document) {
            $actual_count++;
            $this->assertTrue($document->isAnnotated());
            $this->assertEquals(self::FIX_CLASS, $document->getClass());
        }
        $this->assertEquals(self::FIX_RECORD_CNT, $actual_count);
    }
}
