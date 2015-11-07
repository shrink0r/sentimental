<?php

namespace Shrink0r\Sentimental\Classifier\NaiveBayes;

use Shrink0r\Sentimental\Classifier\ClassifierInterface;
use Shrink0r\Sentimental\Feature\FeatureExtractionInterface;

class Classifier implements ClassifierInterface
{
    protected $frequency_table;

    protected $feature_extraction;

    public function __construct(FeatureExtractionInterface $feature_extraction, FrequencyTable $frequency_table)
    {
        $this->feature_extraction = $feature_extraction;
        $this->frequency_table = $frequency_table;
    }

    public function score($content, $sort = false)
    {
        $class_scores = [];
        foreach ($this->frequency_table->getSupportedClasses() as $class) {
            $class_scores[$class] = 1;
            foreach ($this->feature_extraction->extract($content) as $feature) {
                $class_scores[$class] *= $this->frequency_table->getFeatureProbability($feature, $class);
            }
            $class_scores[$class] *= $this->frequency_table->getPriorProbability($class);
        }

        if ($sort) {
            arsort($class_scores);
        }

        return $class_scores;
    }

    public function classify($content)
    {
        $class_scores = $this->score($content, true);

        return key($class_scores);
    }
}
