<?php

namespace SpojPour1\Math;

class CachedGcdCalculator implements GcdCalculatorInterface
{
    private array $cache = [];

    public function __construct(
        private GcdCalculatorInterface $calculator
    ) {
    }

    /**
     * Calculate the greatest common divisor of two numbers using a cached calculator.
     *
     * This method will first check if the GCD of the given numbers is already in the cache.
     * If it is, it will return the cached value.
     * If not, it will calculate the GCD using the provided calculator and store the result
     * in the cache.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The greatest common divisor of $a and $b.
     */
    public function calculate(int $a, int $b): int
    {
        // Normalize order for cache key
        $key = min($a, $b) . ':' . max($a, $b);

        if (!isset($this->cache[$key])) {
            $this->cache[$key] = $this->calculator->calculate($a, $b);
        }

        return $this->cache[$key];
    }
}
