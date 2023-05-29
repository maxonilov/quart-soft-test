<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Subscription\SubscriptionRepository;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserSubscription\UserSubscriptionRepository;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use App\Services\Article\ArticleService;
use App\Services\Article\ArticleServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use App\Services\Payment\Interface\PaymentServiceInterface;
use App\Services\Payment\PaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthServiceInterface::class, AuthService::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->singleton(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->singleton(PaymentServiceInterface::class, PaymentService::class);
        $this->app->singleton(UserSubscriptionRepositoryInterface::class, UserSubscriptionRepository::class);
        $this->app->singleton(ArticleServiceInterface::class, ArticleService::class);
        $this->app->singleton(ArticleRepositoryInterface::class, ArticleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
