<?php

declare(strict_types=1);

use App\Movies;
use App\RandomRecommendationStrategy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RandomRecommendationStrategy::class)]
final class RandomRecommendationStrategyTest extends TestCase
{
    private array $movies;

    protected function setUp(): void
    {
        $this->movies = Movies::MOVIES;
    }

    public function testRecommendReturnThreeMovies(): void
    {
        $strategy = new RandomRecommendationStrategy();
        $result = $strategy->recommend($this->movies);

        $this->assertCount(3, $result, 'dupa');
        $this->assertContainsOnlyString($result);
    }

    public function testRecommendHandlesEmptyArray(): void
    {
        $strategy = new RandomRecommendationStrategy();
        $movies = [];
        $result = $strategy->recommend($movies);

        $this->assertEmpty($result);
    }
}
