<?php

namespace Shrink0r\Sentimental\Data;

use IteratorAggregate;

interface DataSetInterface extends IteratorAggregate
{
    public function getWeight();
}
