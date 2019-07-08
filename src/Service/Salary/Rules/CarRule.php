<?php

namespace App\Service\Salary\Rules;

use App\Entity\Employee;
use App\Service\Salary\RuleInterface;
use App\Service\Salary\Statement;

/**
 * If an employee wants to use a company car we need to deduct $500
 */
class CarRule implements RuleInterface
{
    /**
     * Returns updated statement for given employee
     * @param Employee $employee
     * @param Statement $statement
     * @return Statement
     */
    public function apply(Employee $employee, Statement $statement): Statement
    {
        if ($employee->getUsesCar() == 1) {
            $statement->addModifier('Using a company car', -500);
        }
        return $statement;
    }
}
