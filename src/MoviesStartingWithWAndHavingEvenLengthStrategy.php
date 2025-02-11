<?php

declare(strict_types=1);

namespace App;

class MoviesStartingWithWAndHavingEvenLengthStrategy implements RecommendationStrategy
{
    public function recommend(array $movies): array
    {
        return array_filter(
            $movies,
            fn($movie) => true === str_starts_with($movie, 'W') && (mb_strlen($movie, 'UTF-8') % 2 === 0)
        );
    }
}


