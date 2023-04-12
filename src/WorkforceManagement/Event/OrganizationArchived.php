<?php

namespace App\WorkforceManagement\Event;

use App\WorkforceManagement\Domain\Subscription;
use Symfony\Component\Uid\Ulid;

readonly class OrganizationArchived
{
    /**
     * @param string $organizationId
     * @param string $subscription
     */
    public function __construct(private string $organizationId, private string $subscription)
    {
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
    public function getSubscription(): string
    {
        return $this->subscription;
    }
}