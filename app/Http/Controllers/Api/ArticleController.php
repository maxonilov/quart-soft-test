<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\SubscriptionNotExistException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Article\CreateRequest;
use App\Http\Resources\Api\ArticleResource;
use App\Services\Article\ArticleServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ArticleController extends Controller
{
    /**
     * @param CreateRequest $request
     * @param ArticleServiceInterface $service
     * @return ArticleResource
     */
    public function store(
        CreateRequest $request,
        ArticleServiceInterface $service
    ): ArticleResource {
        try {
            return ArticleResource::make(
                $service->create($request->toDto(), auth()->user())
            );
        } catch (SubscriptionNotExistException $e) {
            throw new AccessDeniedHttpException($e->getMessage());
        }
    }
}
