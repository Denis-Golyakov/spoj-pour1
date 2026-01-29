<?php
namespace SpojPour1\Solver;

use SpojPour1\Math\MathHelper;

class PourSolver
{
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
    public function solve(int $capacityA, int $capacityB, int $capacityC): int
    {
        // Impossible to fill the containers
        if ($capacityC > $capacityA && $capacityC > $capacityB)
            return -1;
        if ($capacityC % MathHelper::greatestCommonDivisor($capacityA, $capacityB) !== 0)
            return -1;

        // One of the containers' capacity is equal to the target capacity
        if ($capacityA === $capacityC || $capacityB === $capacityC)
            return 1;

        // Calculate the minimum number of attempts
        return min(
            $this->pour($capacityA, $capacityB, $capacityC),
            $this->pour($capacityB, $capacityA, $capacityC)
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
    private function pour(int $capacityA, int $capacityB, int $capacityC): int
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
}