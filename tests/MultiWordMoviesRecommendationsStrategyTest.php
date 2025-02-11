<?php

declare(strict_types=1);

use App\Movies;
use App\MultiWordMoviesRecommendationsStrategy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MultiWordMoviesRecommendationsStrategy::class)]
final class MultiWordMoviesRecommendationsStrategyTest extends TestCase
{
    private array $movies;

    protected function setUp(): void
    {
        $this->movies = Movies::MOVIES;
    }

    public function testReturnsOnlyMultiWordMovies(): void
    {
        $strategy = new MultiWordMoviesRecommendationsStrategy();
        $result = $strategy->recommend($this->movies);
        $expected = ['Leon zawodowiec', 'Piraci z Karaibów: Klątwa Czarnej Perły'];

        array_walk($expected, fn($movie) => $this->assertContains($movie, $result));
    }

    public function testReturnsEmptyArrayWhenNoMultiWordMovies(): void
    {
        $strategy = new MultiWordMoviesRecommendationsStrategy();
        $result = $strategy->recommend(['Up', 'Jaws', 'Titanic']);
        $this->assertEmpty($result);
    }

    public function testReturnsEmptyArrayWhenEmptyArray(): void
    {
        $strategy = new MultiWordMoviesRecommendationsStrategy();
        $result = $strategy->recommend([]);
        $this->assertEmpty($result);
    }
}
