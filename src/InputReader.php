<?php
namespace SpojPour1\IO;

class InputReader
{
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
    public function readInput(): array
    {
        $testCaseNumber = $this->readIntegerInput(1, 100); // t
        $testCases = [];

        for ($i = 0; $i < $testCaseNumber; $i++) {
            $testCases[] = [
                'capacityA' => $this->readIntegerInput(1, 40000), // a
                'capacityB' => $this->readIntegerInput(1, 40000), // b
                'capacityC' => $this->readIntegerInput(1, 40000), // c
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
     * @throws \Exception If the input integer is not within the given range.
     */
    private static function readIntegerInput(int $minValue = 0, int $maxValue = PHP_INT_MAX): int
    {
        $inputValue = intval(trim(fgets(STDIN)));

        if ($inputValue < $minValue || $inputValue > $maxValue) {
            throw new \InvalidArgumentException(
                'Input must be within the range of ' . $minValue . ' and ' . $maxValue
            );
        }

        return $inputValue;
    }
}