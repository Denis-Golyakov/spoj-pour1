<?php

namespace SpojPour1\Math;

class MathHelper
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
    public static function greatestCommonDivisor(int $a, int $b): int
    {
        if ($b === 0) { // Prevent division by zero
            return $a;
        }

        return ($a % $b) ? self::greatestCommonDivisor($b, $a % $b) : $b;
    }
}