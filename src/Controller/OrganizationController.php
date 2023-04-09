<?php

namespace App\Controller;

use App\WorkforceManagement\Command\Subscribe;
use App\WorkforceManagement\Domain\Subscription;
use Ecotone\Modelling\CommandBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrganizationController
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {}

    #[Route('/subscribe', name: 'app_organization_subscribe')]
    public function subscribe(): Response
    {
        $subscribeOrganizationCommand = new Subscribe(
            "My org",
            true,
            Subscription::FREE
        );

        $result = $this->commandBus->send($subscribeOrganizationCommand);

        return new Response("Hello " . json_encode($result));
    }
}