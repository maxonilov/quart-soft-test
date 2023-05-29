<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Services\Article\Dto\CreateDto;

interface ArticleRepositoryInterface
{
    /**
     * @param CreateDto $dto
     * @return Article
     */
    public function create(CreateDto $dto): Article;
}
