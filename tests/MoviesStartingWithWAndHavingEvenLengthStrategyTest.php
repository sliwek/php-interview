<?php

namespace App\tests;

use App\MoviesStartingWithWAndHavingEvenLengthStrategy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MoviesStartingWithWAndHavingEvenLengthStrategy::class)]
final class MoviesStartingWithWAndHavingEvenLengthStrategyTest extends TestCase
{
    public function testReturnsMoviesStartingWithWAndHavingEvenLength(): void
    {
        $strategy = new MoviesStartingWithWAndHavingEvenLengthStrategy();
        $movies = ['WALL-E', 'Wonder Woman', 'Warrior', 'W'];
        $result = $strategy->recommend($movies);
        $expected = ['WALL-E', 'Wonder Woman'];

        $this->assertEquals($expected, $result);
    }

    public function testReturnsEmptyArrayWhenNoMoviesStartWithW(): void
    {
        $strategy = new MoviesStartingWithWAndHavingEvenLengthStrategy();
        $movies = ['The Matrix', 'Toy Story', 'The Godfather'];
        $result = $strategy->recommend($movies);

        $this->assertEmpty($result);
    }

    public function testReturnsEmptyArrayWhenNoMoviesHaveEvenLength(): void
    {
        $strategy = new MoviesStartingWithWAndHavingEvenLengthStrategy();
        $movies = ['W', 'Warrior'];
        $result = $strategy->recommend($movies);

        $this->assertEmpty($result);
    }
}
