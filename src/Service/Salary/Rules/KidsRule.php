<?php

namespace App\Service\Salary\Rules;

use App\Entity\Employee;
use App\Service\Salary\RuleInterface;
use App\Service\Salary\Statement;

/**
 * If an employee has more than 2 kids we want to decrease his Tax by 2%
 */
class KidsRule implements RuleInterface
{
    /**
     * Returns updated statement for given employee
     * @param Employee $employee
     * @param Statement $statement
     * @return Statement
     */
    public function apply(Employee $employee, Statement $statement): Statement
    {
        if ($employee->getKids() > 2) {
            $statement->addTaxDiscount('Has more than 2 kids', -2);
        }
        return $statement;
    }
}
