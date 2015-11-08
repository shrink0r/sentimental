<?php

namespace Shrink0r\Sentimental\Classifier;

use Shrink0r\Sentimental\Data\DataSetInterface;

interface EvaluationInterface
{
    public function generateResult(DataSetInterface $data_set);
}

