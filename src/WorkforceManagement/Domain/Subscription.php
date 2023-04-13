<?php

namespace App\WorkforceManagement\Domain;

enum Subscription: string
{
    case FREE = 'FREE';
    case TRYOUT = 'TRYOUT';
    case PLUS = 'PLUS';
    case PREMIUM = 'PREMIUM';
    case READ_ONLY = 'READ_ONLY';

    public static function fromString(string $getPlan): self
    {
        return self::from($getPlan);
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
