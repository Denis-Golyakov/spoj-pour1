<?php

namespace SpojPour1\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use SpojPour1\Solver\PourSolver;

#[CoversClass(PourSolver::class)]
class PourSolverTest extends TestCase
{
    private PourSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PourSolver();
    }

    #[DataProvider('solveDataProvider')]
    public function testSolve(int $capacityA, int $capacityB, int $targetCapacity, int $expected): void
    {
        $this->assertSame(
            $expected,
            $this->solver->solve($capacityA, $capacityB, $targetCapacity)
        );
    }

    public static function solveDataProvider(): array
    {
        return [
            'Example from SPOJ' => [5, 2, 3, 2],
            'Target impossible (too large)' => [2, 3, 5, -1],
            'Target impossible (GCD mismatch)' => [2, 4, 3, -1],
            'Direct hit A' => [5, 2, 5, 1],
            'Direct hit B' => [5, 2, 2, 1],
            'Large values' => [40000, 39999, 1, 2], // Should be efficient
        ];
    }
}
