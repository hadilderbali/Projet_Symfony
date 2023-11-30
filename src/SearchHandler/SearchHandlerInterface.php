<?php

namespace App\SearchHandler;

interface SearchHandlerInterface
{
    public function handleSearch(?string $search, ?string $publishedAfter): array;
}