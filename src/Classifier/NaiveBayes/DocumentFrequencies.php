<?php

namespace Shrink0r\Sentimental\Classifier\NaiveBayes;

class DocumentFrequencies
{
    protected $frequencies = [];

    protected $total_count = 0;

    public function __construct(array $frequencies, $total_count)
    {
        $this->frequencies = $frequencies;
        $this->total_count = $total_count;
    }

    public function getFrequency($class)
    {
        return isset($this->frequencies[$class]) ? $this->frequencies[$class] : 0;
    }

    public function getTotalCount()
    {
        return $this->total_count;
    }

    public function getFrequencies()
    {
        return $this->frequencies;
    }
}
