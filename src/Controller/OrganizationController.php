<?php

namespace App\Controller;

use App\WorkforceManagement\Command\Subscribe;
use App\WorkforceManagement\Domain\Subscription;
use App\WorkforceManagement\Infrastructure\OrganizationInMemoryRepository;
use Ecotone\Modelling\CommandBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/organization', name: 'app_organization')]
class OrganizationController
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly OrganizationInMemoryRepository $repository,
    ) {}

    #[Route('/subscribe', name: 'app_organization_subscribe')]
    public function subscribe(): Response
    {
        $subscribeOrganizationCommand = new Subscribe(
            "My org",
            Subscription::FREE->value,
            true,
        );

        $result = $this->commandBus->send($subscribeOrganizationCommand);

        return new Response(json_encode($result));
    }

    #[Route('/', name: 'app_organization_list')]
    public function list(): Response
    {
        $organizations = $this->repository->findAll();

        return new Response(json_encode($organizations));
    }
}