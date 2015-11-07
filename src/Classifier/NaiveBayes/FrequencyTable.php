<?php

namespace Shrink0r\Sentimental\Classifier\NaiveBayes;

class FrequencyTable
{
    protected $feature_frequencies;

    protected $record_frequencies;

    public function __construct(FeatureFrequencies $feature_frequencies, RecordFrequencies $record_frequencies)
    {
        $this->feature_frequencies = $feature_frequencies;
        $this->record_frequencies = $record_frequencies;
        // pre calculate the prior-probabilities, based on the plain record/class ratio before any data is seen.
        $this->prior_probabilities = [];
        foreach($this->getSupportedClasses() as $class) {
            $this->prior_probabilities[$class] = $this->getRecordFrequency($class) / $this->getTotalRecordCount();
        }
    }

    public function getSupportedClasses()
    {
        return array_keys($this->getFeatureFrequencies()->getClassFrequencies());
    }

    public function getPriorProbabilities()
    {
        return $this->prior_probabilities;
    }

    public function getPriorProbability($class)
    {
        return isset($this->prior_probabilities[$class]) ? $this->prior_probabilities[$class] : 0;
    }

    public function getFeatureProbability($feature, $class)
    {
        return $this->feature_frequencies->getProbability($feature, $class);
    }

    public function getFeatureFrequency($feature, $class)
    {
        return $this->feature_frequencies->getFrequency($feature, $class);
    }

    public function getRecordFrequency($class)
    {
        return $this->record_frequencies->getFrequency($class);
    }

    public function getTotalFeatureCount()
    {
        return $this->feature_frequencies->getTotalCount();
    }

    public function getTotalRecordCount()
    {
        return $this->record_frequencies->getTotalCount();
    }

    public function getDocFrequencies()
    {
        return $this->record_frequencies;
    }

    public function getFeatureFrequencies()
    {
        return $this->feature_frequencies;
    }
}
