<?php

namespace App\Service\Salary\Rules;

use App\Entity\Employee;
use App\Service\Salary\RuleInterface;
use App\Service\Salary\Statement;

/**
 * If an employee older than 50 we want to add 7% to his salary
 */
class AgeRule implements RuleInterface
{
    /**
     * Returns updated statement for given employee
     * @param Employee $employee
     * @param Statement $statement
     * @return Statement
     */
    public function apply(Employee $employee, Statement $statement): Statement
    {
        if ($employee->getAge() > 50) {
            $amount = $employee->getSalary() * 0.07;
            $statement->addModifier('Older than 50', $amount);
        }
        return $statement;
    }
}
