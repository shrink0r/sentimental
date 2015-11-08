<?php

namespace Shrink0r\Sentimental\Classifier;

class EvaluationResult
{
    protected $total_stats;

    protected $class_stats;

    public function __construct(array $class_stats)
    {
        $this->overall_results = [];
        $this->class_stats = $class_stats;

        $total_hits = 0;
        $total_misses = 0;
        foreach ($this->class_stats as &$stats) {
            $total_hits += $stats['hits'];
            $total_misses += $stats['misses'];
            $stats['accuracy'] = (1 / ($stats['hits'] + $stats['misses'])) * $stats['hits'];
        }
        $total_accuracy = (1 / ($total_hits + $total_misses)) * $total_hits;

        $this->total_stats = [
            'hits' => $total_hits,
            'misses' => $total_misses,
            'accuracy' => $total_accuracy
        ];
    }

    public function getAffectedClasses()
    {
        return array_keys($this->class_stats);
    }

    public function getAccuracy($class = null)
    {
        if (isset($this->class_stats[$class])) {
            return $this->class_stats[$class]['accuracy'];
        }
        return $this->total_stats['accuracy'];
    }

    public function getHits($class = null)
    {
        if (isset($this->class_stats[$class])) {
            return $this->class_stats[$class]['hits'];
        }
        return $this->total_stats['hits'];
    }

    public function getMisses($class = null)
    {
        if (isset($this->class_stats[$class])) {
            return $this->class_stats[$class]['misses'];
        }
        return $this->total_stats['misses'];
    }
}
