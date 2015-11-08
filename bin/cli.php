<?php

use Shrink0r\Sentimental\Classifier\NaiveBayes\ClassificationTrainer;
use Shrink0r\Sentimental\Classifier\QualitityTest;
use Shrink0r\Sentimental\Classifier\Stats;
use Shrink0r\Sentimental\Data\AnnotatedFile;
use Shrink0r\Sentimental\Data\DictionaryInclude;
use Shrink0r\Sentimental\Data\NewlineSeparatedFile;
use Shrink0r\Sentimental\Feature\StopWordFilteredTokens;

require dirname(__DIR__) . '/vendor/autoload.php';

function printTestResult(Stats $test_stats) {
    echo "------ Classification Quality Results -----\n\n";
    echo "Overall:\n";
    echo "- Hits: " . $test_stats->getHits() . PHP_EOL;
    echo '- Misses: ' . $test_stats->getMisses() . PHP_EOL;
    echo "- Accuracy: " . $test_stats->getAccuracy() . PHP_EOL . PHP_EOL;
    foreach ($test_stats->getAffectedClasses() as $class) {
        echo "Feature '" . $class . "':\n";
        echo "- Hits: " . $test_stats->getHits($class) . PHP_EOL;
        echo '- Misses: ' . $test_stats->getMisses($class) . PHP_EOL;
        echo "- Accuracy: " . $test_stats->getAccuracy($class) . PHP_EOL . PHP_EOL;
    }
};

$qualitity_test = new QualitityTest(
     ClassificationTrainer::train(
        [
            new DictionaryInclude(dirname(__DIR__) . '/data/training/sentiments/negative.catalog.php', 'troll', 5),
            new NewlineSeparatedFile(dirname(__DIR__) . '/data/training/troll_styles/trollzip-insults.txt', 'troll', 5),
            new NewlineSeparatedFile(dirname(__DIR__) . '/data/training/troll_styles/trollzip-noninsults.txt', 'notroll')
        ],
        new StopWordFilteredTokens(require dirname(__DIR__) . '/data/stop_words.php')
    )
);

$test_stats = $qualitity_test->evaluate(
    new AnnotatedFile(dirname(__DIR__) . '/data/testing/reddit.txt')
);

printTestResult($test_stats);
