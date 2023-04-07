<?php

namespace App\WorkforceManagement\Infrastructure;

use App\WorkforceManagement\Domain\Subscription;
use Ramsey\Collection\Collection;
use Symfony\Component\Uid\Ulid;

class OrganizationInMemoryRepository
{

    /**
     * @var Collection<Organization>
     */
    private Collection $organizations;

    public function __construct() {
        $this->organizations = new Collection(Organization::class);
    }

    public function store(Organization $organization): bool
    {
        return $this->organizations->add(
            $organization
        );
    }

    public function archive(Ulid $organizationId, Subscription $subscription): bool
    {
        foreach ($this->organizations as &$organization) {
            if ($organization->organizationId->equals($organizationId)) {
                $organization->active = false;
                $organization->plan = $subscription;

                return true;
            }
        }

        return false;
    }
}