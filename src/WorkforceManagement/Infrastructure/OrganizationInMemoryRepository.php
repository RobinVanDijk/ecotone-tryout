<?php

namespace App\WorkforceManagement\Infrastructure;

use App\WorkforceManagement\Domain\Subscription;
use Ramsey\Collection\Collection;
use Symfony\Component\Uid\Ulid;

class OrganizationInMemoryRepository
{
    private static OrganizationInMemoryRepository $instance;

    /**
     * @var Collection<Organization>
     */
    private Collection $organizations;

    public function __construct() {
        $this->organizations = new Collection(Organization::class);
    }

    public static function getInstance(): OrganizationInMemoryRepository
    {
        if(!isset(self::$instance))
        {
            self::$instance = new OrganizationInMemoryRepository();
        }
        return self::$instance;
    }

    public function store(Organization $organization): bool
    {
        return $this->organizations->add(
            $organization
        );
    }

    public function archive(string $organizationId, string $subscription): bool
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

    public function findAll(): array
    {
        return $this->organizations->toArray();
    }

    public function findById(string $organizationId): ?Organization
    {
        foreach ($this->organizations as $organization) {
            if ($organization->organizationId->equals($organizationId)) {
                return $organization;
            }
        }

        return null;
    }
}