<?php

namespace App\Tests\Service\Salary\Rules;

use App\DataFixtures\EmployeeFixtures;
use App\Service\Salary\Rules\KidsRule;
use App\Service\Salary\Statement;
use PHPUnit\Framework\TestCase;

/**
 * Test for Kids Salary Rule
 */
class KidsRuleTest extends TestCase
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
     * @var KidsRule
     */
    public $rule;

    protected function setUp()
    {
        // Get predefined employees
        $this->employees = EmployeeFixtures::generate();

        $this->statement = new Statement();
        $this->rule = new KidsRule();
    }

    public function testApplyToAlice()
    {
        $statement = $this->rule->apply(
            $this->employees['Alice'],
            $this->statement
        );
        $this->assertEmpty($statement->getTaxDiscounts());
    }

    public function testApplyToBob()
    {
        $statement = $this->rule->apply(
            $this->employees['Bob'],
            $this->statement
        );
        $this->assertEmpty($statement->getTaxDiscounts());
    }

    public function testApplyToCharlie()
    {
        $statement = $this->rule->apply(
            $this->employees['Charlie'],
            $this->statement
        );
        $this->assertArrayHasKey(
            'Has more than 2 kids',
            $statement->getTaxDiscounts()
        );
        $this->assertEquals(
            -2,
            $statement->getTaxDiscounts()['Has more than 2 kids']
        );
    }
}
