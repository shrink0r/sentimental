<?php

namespace Shrink0r\Sentimental\Data;

use Shrink0r\Sentimental\Data\Record;
use SplFileObject;

class NewlineSeparatedFile implements DataSetInterface
{
    protected $file_path;

    protected $class;

    protected $weight;

    public function __construct($file_path, $class, $weight = 0)
    {
        $this->file_path = $file_path;
        $this->class = $class;
        $this->weight = $weight;
    }

    public function getIterator()
    {
        $file = new SplFileObject($this->file_path);

        while (!$file->eof()) {
            $content = trim($file->fgets());
            yield new Record($content, $this->class);
        }
    }

    public function getWeight()
    {
        return $this->weight;
    }
}
