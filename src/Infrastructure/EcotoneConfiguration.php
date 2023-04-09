<?php
namespace App\Infrastructure;
use Ecotone\EventSourcing\EventSourcingConfiguration;
use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\Dbal\Configuration\DbalConfiguration;

class EcotoneConfiguration
{
    /*#[ServiceContext]
    public function getDbalConfiguration(): DbalConfiguration
    {
        return DbalConfiguration::createWithDefaults()
            ->withDoctrineORMRepositories(true);
    }*/

    #[ServiceContext]
    public function getEventSourcingConfiguration(): EventSourcingConfiguration
    {
        return EventSourcingConfiguration::createInMemory();
    }

    #[ServiceContext]
    public function turnOffTransactions(): DbalConfiguration
    {
        return DbalConfiguration::createWithDefaults()
            ->withTransactionOnCommandBus(false);
    }
}