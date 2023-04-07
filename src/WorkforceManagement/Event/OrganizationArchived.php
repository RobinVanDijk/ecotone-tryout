<?php

namespace App\WorkforceManagement\Event;

use App\WorkforceManagement\Domain\Subscription;
use Symfony\Component\Uid\Ulid;

readonly class OrganizationArchived
{
    /**
     * @param Ulid $organizationId
     * @param Subscription $subscription
     */
    public function __construct(private Ulid $organizationId, private Subscription $subscription)
    {
    }

    /**
     * @return Ulid
     */
    public function getOrganizationId(): Ulid
    {
        return $this->organizationId;
    }

    /**
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }
}