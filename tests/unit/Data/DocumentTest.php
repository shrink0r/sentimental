<?php

namespace Shrink0r\Sentimental\Tests\Feature;

use Shrink0r\Sentimental\Data\Document;

class DocumentTest extends \PHPUnit_Framework_TestCase
{
    const FIX_CONTENT = 'Hello world!';

    const FIX_CLASS = 'class1';

    public function testCreate()
    {
        $document = new Document(self::FIX_CONTENT);

        $this->assertFalse($document->isAnnotated());
        $this->assertEquals(self::FIX_CONTENT, $document->getContent());
    }

    public function testCreateAnnotated()
    {
        $document = new Document(self::FIX_CONTENT, self::FIX_CLASS);

        $this->assertTrue($document->isAnnotated());
        $this->assertEquals(self::FIX_CONTENT, $document->getContent());
        $this->assertEquals(self::FIX_CLASS, $document->getClass());
    }
}
