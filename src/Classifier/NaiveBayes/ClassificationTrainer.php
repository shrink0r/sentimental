<?php

namespace Shrink0r\Sentimental\Classifier\NaiveBayes;

use Shrink0r\Sentimental\Data\AnnotationGuard;
use Shrink0r\Sentimental\Feature\FeatureExtractionInterface;

class ClassificationTrainer
{
    public static function train(array $training_sets, FeatureExtractionInterface $feature_extraction)
    {
        $document_count = 0;
        $feature_count = 0;
        $feature_freq = [];
        $class_freq = [];
        $document_freq = [];

        foreach ($training_sets as $data_set) {
            $guarded_data = new AnnotationGuard($data_set);
            foreach ($guarded_data as $training_document) {
                // set document stats
                $class = $training_document->getClass();
                $document_count++;
                if(!isset($document_freq[$class])) {
                    $document_freq[$class] = 0;
                }
                $document_freq[$class]++;

                // set feature stats
                $features = $feature_extraction->extract($training_document->getContent());
                foreach($features as $feature) {
                    $feature_count++;
                    if(!isset($feature_freq[$feature][$class])) {
                        $feature_freq[$feature][$class] = $data_set->getWeight();
                    }
                    $feature_freq[$feature][$class]++;
                    if(!isset($class_freq[$class])) {
                        $class_freq[$class] = $data_set->getWeight();
                    }
                    $class_freq[$class]++;
                }
            }
        }

        return new Classifier(
            $feature_extraction,
            new FrequencyTable(
                new FeatureFrequencies($feature_freq, $class_freq, $feature_count),
                new DocumentFrequencies($document_freq, $document_count)
            )
        );
    }
}
