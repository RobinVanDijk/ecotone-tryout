<?php

namespace App\WorkforceManagement\Domain;

use Exception;

class ExpiredPlan extends Exception
{

    public function __construct()
    {
        parent::__construct('Your plan is expired');
    }
}