<?php

namespace Shrink0r\Sentimental\Classifier;

interface ClassifierInterface
{
    public function score($document);

    public function classify($document);
}
