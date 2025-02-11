<?php

declare(strict_types=1);

namespace App;

final class MovieRecommendation
{
    public function __construct(private readonly array $movies, private RecommendationStrategy $strategy) {}

    public function getRecommendations(): array
    {
        return $this->strategy->recommend($this->movies);
    }

    public function setStrategy(RecommendationStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }
}
