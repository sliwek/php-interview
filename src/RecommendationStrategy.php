<?php

declare(strict_types=1);

namespace App;

interface RecommendationStrategy
{
    public function recommend(array $movies): array;
}
