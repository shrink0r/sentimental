<?php

namespace Shrink0r\Sentimental\Tests\Feature;

use Shrink0r\Sentimental\Feature\StopWordFilteredTokens;

class StopWordFilteredTokensTest extends \PHPUnit_Framework_TestCase
{
    public function testExtract()
    {
        $content = "Hello world! This is a test, you know. I'm pretty sure you've seen something like this before";
        $expected_tokens = [
            'hello', 'world', 'this', 'is', 'a', 'test', 'you', 'know',
            'i\'m', 'pretty', 'sure', 'you\'ve', 'seen', 'something', 'like', 'this', 'before'
        ];

        $feature_extraction = new StopWordFilteredTokens();
        $features = $feature_extraction->extract($content);

        $this->assertEquals($expected_tokens, $features);
    }

    public function testExtractWithStopWords()
    {
        $stop_words = [ 'is', 'a', 'this', 'that' ];
        $content = "Hello world! This is a test, you know. I'm pretty sure you've seen something like this before";
        $expected_tokens = [
            'hello', 'world', 'test', 'you', 'know',
            'i\'m', 'pretty', 'sure', 'you\'ve', 'seen', 'something', 'like', 'before'
        ];

        $feature_extraction = new StopWordFilteredTokens($stop_words);
        $features = $feature_extraction->extract($content);

        $this->assertEquals($expected_tokens, $features);
    }
}
