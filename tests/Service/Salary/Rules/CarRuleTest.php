<?php

namespace App\Tests\Service\Salary\Rules;

use App\DataFixtures\EmployeeFixtures;
use App\Service\Salary\Rules\CarRule;
use App\Service\Salary\Statement;
use PHPUnit\Framework\TestCase;

/**
 * Test for Car Salary Rule
 */
class CarRuleTest extends TestCase
{
    /**
     * @var array
     */
    public $employees;
    /**
     * @var Statement
     */
    public $statement;
    /**
     * @var CarRule
     */
    public $rule;

    protected function setUp()
    {
        // Get predefined employees
        $this->employees = EmployeeFixtures::generate();

        $this->statement = new Statement();
        $this->rule = new CarRule();
    }

    public function testApplyToAlice()
    {
        $statement = $this->rule->apply(
            $this->employees['Alice'],
            $this->statement
        );
        $this->assertEmpty($statement->getModifiers());
    }

    public function testApplyToBob()
    {
        $statement = $this->rule->apply(
            $this->employees['Bob'],
            $this->statement
        );
        $this->assertArrayHasKey(
            'Using a company car',
            $statement->getModifiers()
        );
        $this->assertEquals(
            -500,
            $statement->getModifiers()['Using a company car']
        );
    }

    public function testApplyToCharlie()
    {
        $statement = $this->rule->apply(
            $this->employees['Charlie'],
            $this->statement
        );
        $this->assertArrayHasKey(
            'Using a company car',
            $statement->getModifiers()
        );
        $this->assertEquals(
            -500,
            $statement->getModifiers()['Using a company car']
        );
    }
}
