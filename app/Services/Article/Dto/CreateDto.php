<?php

namespace App\Services\Article\Dto;

class CreateDto
{
    public int $userSubscriptionId;
    public int $status;
    public string $title;
    public string $text;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_subscription_id' => $this->userSubscriptionId,
            'status'               => $this->status,
            'title'                => $this->title,
            'text'                 => $this->text
        ];
    }
}
