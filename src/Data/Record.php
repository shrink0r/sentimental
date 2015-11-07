<?php

namespace Shrink0r\Sentimental\Data;

class Record implements RecordInterface
{
    protected $class;

    protected $content;

    public function __construct($content, $class = null)
    {
        $this->content = $content;
        $this->class = $class;
    }

    public function isAnnotated()
    {
        return !is_null($this->class);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getContent()
    {
        return $this->content;
    }
}
