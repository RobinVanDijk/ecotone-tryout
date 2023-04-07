<?php

namespace App\WorkforceManagement\Domain;

use App\WorkforceManagement\Command\Archive;
use App\WorkforceManagement\Command\Subscribe;
use App\WorkforceManagement\Event\OrganizationArchived;
use App\WorkforceManagement\Event\OrganizationSubscribed;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateVersioning;
use Symfony\Component\Uid\Ulid;

#[EventSourcingAggregate]
final class Organization
{
    use WithAggregateVersioning;
    #[AggregateIdentifier]
    private Ulid $organizationId;
    private bool $active;
    private Subscription $plan;
    private array $activeUsers = [];
    private const ARCHIVED_PLAN = Subscription::READ_ONLY;

    /**
     * @throws OrganizationAlreadyActive
     * @throws ExpiredPlan
     */
    #[CommandHandler]
    public function subscribe(Subscribe $command): array
    {
        if ($this->active === true) {
            throw new OrganizationAlreadyActive;
        }

        if (!$command->getPlan()->isActive()) {
            throw new ExpiredPlan;
        }

        return [new OrganizationSubscribed(
            $command->getOrganizationId(),
            $command->getName(),
            $command->isActive(),
            $command->getPlan()
        )];
    }

    /**
     * @throws OrganizationAlreadyArchived
     */
    #[CommandHandler]
    public function archive(Archive $command): array
    {
        if ($this->plan === self::ARCHIVED_PLAN) {
            throw new OrganizationAlreadyArchived;
        }

        return [new OrganizationArchived($command->getOrganizationId(), self::ARCHIVED_PLAN)];
    }

    #[EventSourcingHandler]
    public function subscribed(OrganizationSubscribed $event): void
    {
        $this->organizationId = $event->getOrganizationId();
        $this->active = $event->isActive();
        $this->plan = $event->getPlan();
    }

    #[EventSourcingHandler]
    public function archived(OrganizationArchived $event): void
    {
        $this->active = false;
        $this->plan = $event->getSubscription();
    }
}