<?php

namespace App\WorkforceManagement\Event;

use App\WorkforceManagement\Domain\Subscription;
use Symfony\Component\Uid\Ulid;

readonly class OrganizationSubscribed
{

    /**
     * @param string $organizationId
     * @param string $name
     * @param bool $active
     * @param string $plan
     */
    public function __construct(
        private string         $organizationId,
        private string       $name,
        private bool         $active,
        private string $plan
    ) {
    }

    /**
     * @return string
     */
    public function getOrganizationId(): string
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
     * @return string
     */
    public function getPlan(): string
    {
        return $this->plan;
    }
}