<?php

namespace Shrink0r\Sentimental\Classifier;

interface ClassifierInterface
{
    public function score($record);

    public function classify($record);
}
