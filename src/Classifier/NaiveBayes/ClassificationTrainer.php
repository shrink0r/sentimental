<?php

namespace Shrink0r\Sentimental\Classifier\NaiveBayes;

use Shrink0r\Sentimental\Data\AnnotationGuard;
use Shrink0r\Sentimental\Feature\FeatureExtractionInterface;

class ClassificationTrainer
{
    public static function train(array $training_sets, FeatureExtractionInterface $feature_extraction)
    {
        $record_count = 0;
        $feature_count = 0;
        $feature_freq = [];
        $class_freq = [];
        $record_freq = [];

        foreach ($training_sets as $data_set) {
            $guarded_data = new AnnotationGuard($data_set);
            foreach ($guarded_data as $training_record) {
                // set record stats
                $class = $training_record->getClass();
                $record_count++;
                if(!isset($record_freq[$class])) {
                    $record_freq[$class] = 0;
                }
                $record_freq[$class]++;

                // set feature stats
                $features = $feature_extraction->extract($training_record->getContent());
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
                new RecordFrequencies($record_freq, $record_count)
            )
        );
    }
}
