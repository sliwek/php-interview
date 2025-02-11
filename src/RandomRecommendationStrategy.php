<?php

declare(strict_types=1);

namespace App;

use Random\Randomizer;

final class RandomRecommendationStrategy implements RecommendationStrategy
{
    public function recommend(array $movies): array
    {
        if (count($movies) < 4) {
            return $movies;
        }

        $randomizer = new Randomizer();
        $randomKeys = $randomizer->pickArrayKeys($movies, 3);

        return array_map(fn($key) => $movies[$key], $randomKeys);
    }
}
