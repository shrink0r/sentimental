<?php

namespace Shrink0r\Sentimental\Data;

use Shrink0r\Sentimental\Data\Record;
use SplFileObject;

class AnnotatedFile implements DataSetInterface
{
    protected $file_path;

    protected $weight;

    public function __construct($file_path, $weight = 0)
    {
        $this->file_path = $file_path;
        $this->weight = $weight;
    }

    public function getIterator()
    {
        $file = new SplFileObject($this->file_path);

        while (!$file->eof()) {
            // two lines read at a time, where the first one is expected to be the class annotation
            $class = $file->fgets();
            // for the following content
            $content = $file->fgets();

            yield new Record(trim($content), trim($class));
        }
    }

    public function getWeight()
    {
        return $this->weight;
    }
}
