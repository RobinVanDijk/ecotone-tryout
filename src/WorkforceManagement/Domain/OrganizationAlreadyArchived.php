<?php

namespace App\WorkforceManagement\Domain;

use Exception;

class OrganizationAlreadyArchived extends Exception
{

    public function __construct()
    {
        parent::__construct('Organization is already archived');
    }
}