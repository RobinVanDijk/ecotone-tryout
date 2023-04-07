<?php

namespace App\WorkforceManagement\Infrastructure;

use App\WorkforceManagement\Event\OrganizationArchived;
use App\WorkforceManagement\Event\OrganizationSubscribed;
use Ecotone\Modelling\Attribute\EventHandler;

class OrganizationEventHandler
{
    public function __construct(
        private readonly OrganizationInMemoryRepository $repository
    ) {}
    #[EventHandler]
    public function storeOrganization(OrganizationSubscribed $event): void
    {
        $this->repository->store(
            organization: new Organization(
                organizationId: $event->getOrganizationId(),
                name: $event->getName(),
                active: $event->isActive(),
                plan: $event->getPlan()
            )
        );
    }

    #[EventHandler]
    public function archiveOrganization(OrganizationArchived $event): void
    {
        $this->repository->archive(
            organizationId: $event->getOrganizationId(),
            subscription: $event->getSubscription()
        );
    }
}