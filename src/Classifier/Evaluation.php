<?php

namespace Shrink0r\Sentimental\Classifier;

use Shrink0r\Sentimental\Data\AnnotationGuard;
use Shrink0r\Sentimental\Data\DataSetInterface;

class Evaluation implements EvaluationInterface
{
    protected $classifier;

    public function __construct(ClassifierInterface $classifier)
    {
        $this->classifier = $classifier;
    }

    public function generateResult(DataSetInterface $data_set)
    {
        $guarded_data = new AnnotationGuard($data_set);
        $class_stats = [];

        foreach ($guarded_data as $testing_document) {
            $expected_class = $testing_document->getClass();
            if (!isset($class_stats[$expected_class])) {
                $class_stats[$expected_class] = [ 'hits' => 0, 'misses' => 0 ];
            }

            $probable_class = $this->classifier->classify($testing_document->getContent());
            if ($expected_class === $probable_class) {
                $class_stats[$expected_class]['hits']++;
            } else {
                $class_stats[$expected_class]['misses']++;
            }
        }

        return new EvaluationResult($class_stats);
    }
}
