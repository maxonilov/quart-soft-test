<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Services\Article\Dto\CreateDto;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(CreateDto $dto): Article
    {
        /** @var Article $article */
        $article = auth()->user()->articles()->create($dto->toArray());

        return $article;
    }
}
