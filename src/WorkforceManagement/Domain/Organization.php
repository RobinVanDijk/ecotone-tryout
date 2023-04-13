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
    private const ARCHIVED_PLAN = Subscription::READ_ONLY;
    #[AggregateIdentifier]
    private string $organizationId;
    use WithAggregateVersioning;

    private bool $active;
    private Subscription $plan;
    private array $activeUsers = [];

    /**
     * @throws ExpiredPlan
     */
    #[CommandHandler]
    public static function subscribe(Subscribe $command): array
    {
        if (!Subscription::fromString($command->getPlan())->isActive()) {
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

        return [new OrganizationArchived($command->getOrganizationId(), self::ARCHIVED_PLAN->value)];
    }

    #[EventSourcingHandler]
    public function subscribed(OrganizationSubscribed $event): void
    {
        $this->organizationId = $event->getOrganizationId();
        $this->active = $event->isActive();
        $this->plan = Subscription::fromString($event->getPlan());
    }

    #[EventSourcingHandler]
    public function archived(OrganizationArchived $event): void
    {
        $this->active = false;
        $this->plan = Subscription::fromString($event->getSubscription());
    }
}