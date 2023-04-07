<?php

namespace App\WorkforceManagement\Command;

use Symfony\Component\Uid\Ulid;

readonly class Archive
{
    public function __construct(
        private Ulid $organizationId,
    ) {}

    /**
     * @return Ulid
     */
    public function getOrganizationId(): Ulid
    {
        return $this->organizationId;
    }
}