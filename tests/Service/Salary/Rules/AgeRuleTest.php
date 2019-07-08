<?php

namespace App\Tests\Service\Salary\Rules;

use App\DataFixtures\EmployeeFixtures;
use App\Service\Salary\Rules\AgeRule;
use App\Service\Salary\Statement;
use PHPUnit\Framework\TestCase;

/**
 * Test for Age Salary Rule
 */
class AgeRuleTest extends TestCase
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
     * @var AgeRule
     */
    public $rule;

    protected function setUp()
    {
        // Get predefined employees
        $this->employees = EmployeeFixtures::generate();

        $this->statement = new Statement();
        $this->rule = new AgeRule();
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
        $this->assertArrayHasKey('Older than 50', $statement->getModifiers());
        $this->assertEquals(280, $statement->getModifiers()['Older than 50']);
    }

    public function testApplyToCharlie()
    {
        $statement = $this->rule->apply(
            $this->employees['Charlie'],
            $this->statement
        );
        $this->assertEmpty($statement->getModifiers());
    }
}
