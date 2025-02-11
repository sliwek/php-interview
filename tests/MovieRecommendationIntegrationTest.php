<?php

declare(strict_types=1);

use App\MovieRecommendation;
use App\Movies;
use App\MoviesStartingWithWAndHavingEvenLengthStrategy;
use App\MultiWordMoviesRecommendationsStrategy;
use App\RandomRecommendationStrategy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MovieRecommendation::class)]
final class MovieRecommendationIntegrationTest extends TestCase
{
    private array $movies;

    protected function setUp(): void
    {
        $this->movies = Movies::MOVIES;
    }

    public function testRandomRecommendationIntegration(): void
    {
        $strategy = new RandomRecommendationStrategy();
        $movieRecommendation = new MovieRecommendation($this->movies, $strategy);
        $result = $movieRecommendation->getRecommendations();

        $this->assertCount(3, $result);
        array_walk($result, fn($movie) => $this->assertContains($movie, $this->movies));
    }

    public function testMultiWordRecommendationIntegration(): void
    {
        $strategy = new MultiWordMoviesRecommendationsStrategy();
        $movieRecommendation = new MovieRecommendation($this->movies, $strategy);
        $result = $movieRecommendation->getRecommendations();

        array_walk($result, fn($movie) => $this->assertContains($movie, $this->movies));
    }

    public function testMoviesStartingWithWAndHavingEvenLengthStrategyIntegration(): void
    {
        $strategy = new MoviesStartingWithWAndHavingEvenLengthStrategy();
        $movieRecommendation = new MovieRecommendation($this->movies, $strategy);
        $result = $movieRecommendation->getRecommendations();

        array_walk($result, fn($movie) => $this->assertContains($movie, $this->movies));
    }

    public function testSwitchingStrategiesIntegration(): void
    {
        $randomStrategy = new RandomRecommendationStrategy();
        $movieRecommendation = new MovieRecommendation($this->movies, $randomStrategy);
        $this->assertInstanceOf(RandomRecommendationStrategy::class, $randomStrategy);

        $wStrategy = new MoviesStartingWithWAndHavingEvenLengthStrategy();
        $movieRecommendation->setStrategy($wStrategy);
        $this->assertInstanceOf(MoviesStartingWithWAndHavingEvenLengthStrategy::class, $wStrategy);

        $multiWordStrategy = new MultiWordMoviesRecommendationsStrategy();
        $movieRecommendation->setStrategy($multiWordStrategy);
        $this->assertInstanceOf(MultiWordMoviesRecommendationsStrategy::class, $multiWordStrategy);
    }
}
