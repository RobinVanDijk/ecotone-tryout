<?php

namespace App\WorkforceManagement\Command;

use Symfony\Component\Uid\Ulid;

readonly class Subscribe
{
    private string $organizationId;

    public function __construct(
        private string       $name,
        private string $plan,
        private bool         $active = true,
    )
    {
        $this->organizationId = Ulid::generate();
    }

    /**
     * @return Ulid
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getPlan(): string
    {
        return $this->plan;
    }
}