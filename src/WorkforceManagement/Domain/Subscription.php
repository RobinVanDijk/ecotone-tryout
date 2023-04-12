<?php

namespace App\WorkforceManagement\Domain;

enum Subscription
{
    case FREE;
    case TRYOUT;
    case PLUS;
    case PREMIUM;
    case READ_ONLY;

    public static function fromString(string $getPlan): self
    {
        return match ($getPlan) {
            'Subscription::FREE' => Subscription::FREE,
            'Subscription::TRYOUT' => Subscription::TRYOUT,
            'Subscription::PLUS' => Subscription::PLUS,
            'Subscription::PREMIUM' => Subscription::PREMIUM,
            'Subscription::READ_ONLY' => Subscription::READ_ONLY,
        };
    }

    public function toString(): string
    {
        return match ($this) {
            Subscription::FREE => 'Subscription::FREE',
            Subscription::TRYOUT => 'Subscription::TRYOUT',
            Subscription::PLUS => 'Subscription::PLUS',
            Subscription::PREMIUM => 'Subscription::PREMIUM',
            Subscription::READ_ONLY => 'Subscription::READ_ONLY',
        };
    }

    public function userLimit(): int
    {
        return match ($this) {
            Subscription::READ_ONLY => 0,
            Subscription::TRYOUT => 2,
            Subscription::FREE => 5,
            Subscription::PLUS => 20,
            Subscription::PREMIUM => 50,
        };
    }

    public function isActive(): bool
    {
        return match ($this) {
            Subscription::FREE, Subscription::PLUS, Subscription::PREMIUM, Subscription::READ_ONLY => true,
            Subscription::TRYOUT => false,
        };
    }
}
