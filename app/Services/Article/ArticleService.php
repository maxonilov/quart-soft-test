<?php

declare(strict_types=1);

namespace App\Services\Article;

use App\Exceptions\SubscriptionNotExistException;
use App\Models\Article;
use App\Models\User;
use App\References\ArticleStatusReference;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Article\Dto\CreateDto;

class ArticleService implements ArticleServiceInterface
{
    private UserRepositoryInterface $userRepository;
    private ArticleRepositoryInterface $articleRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ArticleRepositoryInterface $articleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @inheritdoc
     */
    public function create(CreateDto $dto, User $user): Article
    {
        $subscription = $this->userRepository->getActiveSubscription($user);
        if (!$subscription) {
            throw new SubscriptionNotExistException();
        }
        $dto->userSubscriptionId = $subscription->id;
        $dto->status = ArticleStatusReference::ACTIVE;

        return $this->articleRepository->create($dto);
    }
}
