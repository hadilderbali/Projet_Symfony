<?php

namespace App\SearchHandler;

use App\Repository\ArticleRepository;

class ArticleSearchHandler implements SearchHandlerInterface
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function handleSearch(?string $search, ?string $publishedAfter): array
    {
        return $this->articleRepository->findByMultiCriteria($search, $publishedAfter);
    }
}
