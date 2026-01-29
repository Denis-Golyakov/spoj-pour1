<?php
/**
 * Entry point
 */
function main(): void
{
    $testCases = readInput();

    foreach ($testCases as $testCase) {
        echo solve($testCase['capacityA'], $testCase['capacityB'], $testCase['capacityC']) . PHP_EOL;
    }
}

/**
 * Process input of the data
 *
 * An integer t, 1 ≤ t ≤ 100, denoting the number of test cases, followed 
 * by t sets of input data, each consisting of three positive integers a, b, c, 
 * not larger than 40000, given in separate lines
 *
 * @return array The test cases as an array of arrays, each containing three
 *          numbers.
 */
function readInput(): array
{
    $testCaseNumber = readIntegerInput(1, 100); // t
    $testCases = [];

    for ($i = 0; $i < $testCaseNumber; $i++) {
        $testCases[] = [
            'capacityA' => readIntegerInput(1, 40000), // a
            'capacityB' => readIntegerInput(1, 40000), // b
            'capacityC' => readIntegerInput(1, 40000), // c
        ];
    }

    return $testCases;
}

/**
 * Reads an integer from the standard input and validates it against the given
 * minimum and maximum values.
 *
 * @param int $minValue The minimum allowed value. Defaults to 0.
 * @param int $maxValue The maximum allowed value. Defaults to PHP_INT_MAX.
 *
 * @return int The validated integer.
 *
 * @throws Exception If the input integer is not within the given range.
 */
function readIntegerInput(int $minValue = 0, int $maxValue = PHP_INT_MAX): int
{
    $inputValue = intval(trim(fgets(STDIN)));

    if ($inputValue < $minValue || $inputValue > $maxValue) {
        throw new InvalidArgumentException(
            'Input must be within the range of ' . $minValue . ' and ' . $maxValue
        );
    }

    return $inputValue;
}

/**
 * Returns either the minimum number of attempts required to reach a target capacity 
 * in either of two vessels or -1 if it is impossible.
 *
 * @param int $capacityA The capacity of the first vessel.
 * @param int $capacityB The capacity of the second vessel.
 * @param int $capacityC The target capacity.
 *
 * @return int The minimum number of attempts required to reach the target capacity.
 */
function solve(int $capacityA, int $capacityB, int $capacityC): int
{
    // Impossible to fill the containers
    if ($capacityC > $capacityA && $capacityC > $capacityB)
        return -1;
    if ($capacityC % gcd($capacityA, $capacityB) !== 0)
        return -1;

    // One of the containers' capacity is equal to the target capacity
    if ($capacityA === $capacityC || $capacityB === $capacityC)
        return 1;

    // Calculate the minimum number of attempts
    return min(
        pour($capacityA, $capacityB, $capacityC),
        pour($capacityB, $capacityA, $capacityC)
    );
}

/**
 * Returns the number of attempts required to reach a target capacity in either of 
 * two vessels.
 *
 * @param int $capacityA The capacity of the first vessel.
 * @param int $capacityB The capacity of the second vessel.
 * @param int $capacityC The target capacity.
 *
 * @return int The number of attempts required to reach the target capacity.
 */
function pour(int $capacityA, int $capacityB, int $capacityC): int
{
    $try = 1; // Initial fill of the first vessel
    $vesselA = $capacityA;
    $vesselB = 0;

    while ($vesselA !== $capacityC && $vesselB !== $capacityC) {
        // Transfer from vessel A to vessel B
        $transferAmount = min($vesselA, $capacityB - $vesselB);
        $vesselB += $transferAmount;
        $vesselA -= $transferAmount;
        $try++;

        if ($vesselA === $capacityC || $vesselB === $capacityC) {
            break; // One of the containers has target capacity
        }

        if ($vesselA === 0) {
            $vesselA = $capacityA; // Refill vessel A
        }
        if ($vesselB === $capacityB) {
            $vesselB = 0; // Empty vessel B
        }
        $try++;
    }

    return $try;
}

/**
 * Calculates the greatest common divisor of two integers using the Euclidean
 * algorithm.
 *
 * @param int $a The first integer.
 * @param int $b The second integer.
 *
 * @return int The greatest common divisor of the two integers.
 */
function gcd(int $a, int $b): int
{
    if ($b === 0) {
        return $a;
    }

    return ($a % $b) ? gcd($b, $a % $b) : $b;
}

main();