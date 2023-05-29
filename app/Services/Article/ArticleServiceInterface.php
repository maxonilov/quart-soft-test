<?php

namespace App\Services\Article;

use App\Exceptions\SubscriptionNotExistException;
use App\Models\Article;
use App\Models\User;
use App\Services\Article\Dto\CreateDto;

interface ArticleServiceInterface
{

    /**
     * @param CreateDto $dto
     * @param User $user
     * @return Article
     * @throws SubscriptionNotExistException
     */
    public function create(CreateDto $dto, User $user): Article;
}
