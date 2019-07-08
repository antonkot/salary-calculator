<?php

namespace App\Service\Salary;

use App\Entity\Employee;
use App\Service\Salary\RuleInterface;
use App\Service\Salary\Statement;

/**
 * Salary Service
 * Configure it before using by adding a rules via `addRule` method
 */
class SalaryService
{
    const COUNTRY_TAX = 20;

    /**
     * @var RuleInterface[]
     */
    private $rules = [];

    /**
     * Adds rule to the list. Allows method chaining.
     * @param RuleInterface $rule The rule object
     * @return SalaryService
     */
    public function addRule(RuleInterface $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }

    /**
     * Calculates statement for given employee
     * @param Employee $employee
     * @return Statement
     */
    public function calculate(Employee $employee)
    {
        // Create new statement
        $statement = new Statement();

        // Apply each rule
        foreach ($this->rules as $rule) {
            $statement = $rule->apply($employee, $statement);
        }

        // Calculate sub total by applying all modifiers
        $statement->subTotal = $employee->getSalary();
        foreach ($statement->getModifiers() as $value) {
            $statement->subTotal += $value;
        }

        // Calculate resulting taxes by applying all discounts
        $tax = self::COUNTRY_TAX;
        foreach ($statement->getTaxDiscounts() as $discount) {
            $tax += $discount;
        }

        // Calculate total tax value
        $statement->taxValue = $statement->subTotal * $tax / 100;

        // Calculate total value
        $statement->total = $statement->subTotal - $statement->taxValue;

        return $statement;
    }
}
