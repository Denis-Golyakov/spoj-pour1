<?php

require __DIR__ . '/vendor/autoload.php';

use SpojPour1\IO\InputReader;
use SpojPour1\Solver\PourSolver;

$inputReader = new InputReader();
$solver = new PourSolver();

try {
    foreach ($inputReader->readInput() as $testCase) {
        echo $solver->solve(
            $testCase['capacityA'],
            $testCase['capacityB'],
            $testCase['capacityC']
        ) . PHP_EOL;
    }
} catch (\Exception $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}