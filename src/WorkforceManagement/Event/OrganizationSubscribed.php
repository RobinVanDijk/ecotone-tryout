<?php

namespace App\WorkforceManagement\Event;

use App\WorkforceManagement\Domain\Subscription;
use Symfony\Component\Uid\Ulid;

readonly class OrganizationSubscribed
{

    /**
     * @param Ulid $organizationId
     * @param string $name
     * @param bool $active
     * @param Subscription $plan
     */
    public function __construct(
        private Ulid         $organizationId,
        private string       $name,
        private bool         $active,
        private Subscription $plan
    ) {
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