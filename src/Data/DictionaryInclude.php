<?php

namespace Shrink0r\Sentimental\Data;

use ArrayIterator;
use Shrink0r\Sentimental\Data\Document;

class DictionaryInclude implements DataSetInterface
{
    protected $data;

    protected $class;

    protected $weight;

    public function __construct($dictionary_path, $class, $weight = 0)
    {
        $this->data = require $dictionary_path;
        $this->class = $class;
        $this->weight = $weight;
    }

    public function getIterator()
    {
        $iterator = new ArrayIterator($this->data);

        foreach ($iterator as $catalog_item) {
            yield new Document($catalog_item, $this->class);
        }
    }

    public function getWeight()
    {
        return $this->weight;
    }
}
