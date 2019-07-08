<?php

namespace App\Service\Salary;

use App\Entity\Employee;
use App\Service\Salary\Statement;

/**
 * Salary rule interface
 */
interface RuleInterface
{
    public function apply(Employee $employee, Statement $statement): Statement;
}
