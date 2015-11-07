<?php

namespace Shrink0r\Sentimental\Classifier\NaiveBayes;

class FeatureFrequencies
{
    protected $total_count = 0;

    protected $frequencies = [];

    protected $class_frequencies = [];

    public function __construct(array $frequencies, array $class_frequencies, $total_count)
    {
        $this->frequencies = $frequencies;
        $this->class_frequencies =  $class_frequencies;
        $this->total_count = $total_count;
    }

    public function getProbability($feature, $class)
    {
        return ($this->getFrequency($feature, $class) + 1) / ($this->getClassFrequency($class) + $this->getTotalCount());
    }

    public function getFrequency($feature, $class)
    {
        return isset($this->frequencies[$feature][$class]) ? $this->frequencies[$feature][$class] : 0;
    }

    public function getClassFrequency($class)
    {
        return isset($this->class_frequencies[$class]) ? $this->class_frequencies[$class] : 0;
    }

    public function getFrequencies()
    {
        return $this->frequencies;
    }

    public function getClassFrequencies()
    {
        return $this->class_frequencies;
    }

    public function getTotalCount()
    {
        return $this->total_count;
    }
}
