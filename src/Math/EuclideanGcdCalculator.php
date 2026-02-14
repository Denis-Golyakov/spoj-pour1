<?php

namespace SpojPour1\Math;

class EuclideanGcdCalculator implements GcdCalculatorInterface
{
    /**
     * Calculates the greatest common divisor of two integers using the Euclidean
     * algorithm.
     *
     * @param int $a The first integer.
     * @param int $b The second integer.
     *
     * @return int The greatest common divisor of the two integers.
     */
    public function calculate(int $a, int $b): int
    {
        if ($b === 0) { // Prevent division by zero
            return $a;
        }

        return ($a % $b) ? $this->calculate($b, $a % $b) : $b;
    }
}
