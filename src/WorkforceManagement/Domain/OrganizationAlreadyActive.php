<?php

namespace App\WorkforceManagement\Domain;

use Exception;

class OrganizationAlreadyActive extends Exception
{

    public function __construct()
    {
        parent::__construct('Organization is already active');
    }
}