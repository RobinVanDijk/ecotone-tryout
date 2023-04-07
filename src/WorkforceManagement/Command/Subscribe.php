<?php

namespace App\WorkforceManagement\Command;

use App\WorkforceManagement\Domain\Subscription;
use Symfony\Component\Uid\Ulid;

readonly class Subscribe
{
    private Ulid $organizationId;

    public function __construct(
        private string       $name,
        private bool         $active = true,
        private Subscription $plan = Subscription::FREE,
    )
    {
        $this->organizationId = new Ulid();
    }

    /**
     * @return Ulid
     */
    public function getOrganizationId(): Ulid
    {
        return $this->organizationId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return Subscription
     */
    public function getPlan(): Subscription
    {
        return $this->plan;
    }
}