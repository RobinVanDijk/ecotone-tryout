<?php

namespace App\WorkforceManagement\Infrastructure;

use App\WorkforceManagement\Domain\Subscription;
use Symfony\Component\Uid\Ulid;

class Organization
{
    public function __construct(
        public Ulid $organizationId,
        public string $name,
        public bool $active,
        public Subscription $plan,
    ) {}
}