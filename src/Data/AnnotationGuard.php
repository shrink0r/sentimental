<?php

namespace Shrink0r\Sentimental\Data;

use RuntimeException;
use Shrink0r\Sentimental\Data\Document;

class AnnotationGuard implements DataSetInterface
{
    protected $guarded_data;

    public function __construct(DataSetInterface $data_set)
    {
        $this->guarded_data = $data_set;
    }

    public function getIterator()
    {
        foreach ($this->guarded_data as $document) {
            if ($document->isAnnotated()) {
                yield $document;
            } else {
                throw new RuntimeException('Given document is not annotated!');
            }
        }
    }

    public function getWeight()
    {
        return $this->guarded_data->getWeight();
    }
}
