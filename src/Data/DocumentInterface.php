<?php

namespace Shrink0r\Sentimental\Data;

interface DocumentInterface
{
    public function getClass();

    public function isAnnotated();

    public function getContent();
}
