<?php

namespace Shrink0r\Sentimental\Data;

use RuntimeException;
use Shrink0r\Sentimental\Data\Record;

class AnnotationGuard implements DataSetInterface
{
    protected $guarded_data;

    public function __construct(DataSetInterface $data_set)
    {
        $this->guarded_data = $data_set;
    }

    public function getIterator()
    {
        foreach ($this->guarded_data as $record) {
            if ($record->isAnnotated()) {
                yield $record;
            } else {
                throw new RuntimeException('Given record is not annotated!');
            }
        }
    }

    public function getWeight()
    {
        return $this->guarded_data->getWeight();
    }
}
