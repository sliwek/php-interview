<?php

declare(strict_types=1);

namespace App;

final class MultiWordMoviesRecommendationsStrategy implements RecommendationStrategy
{
    public function recommend(array $movies): array
    {
        return array_filter($movies, function ($movie) {
            return str_word_count($movie) > 1;
        });
    }
}
