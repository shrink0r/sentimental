<?php

namespace Shrink0r\Sentimental\Data;

interface RecordInterface
{
    public function getClass();

    public function isAnnotated();

    public function getContent();
}
