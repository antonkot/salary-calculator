<?php

namespace App\Tests\Service\Salary;

use App\DataFixtures\EmployeeFixtures;
use App\Service\Salary\Rules\AgeRule;
use App\Service\Salary\Rules\CarRule;
use App\Service\Salary\Rules\KidsRule;
use App\Service\Salary\SalaryService;
use PHPUnit\Framework\TestCase;

/**
 * Test for Salary Service
 */
class SalaryServiceTest extends TestCase
{
    /**
     * @var array
     */
    public $employees;

    /**
     * @var SalaryService
     */
    public $service;

    protected function setUp()
    {
        // Get predefined employees
        $this->employees = EmployeeFixtures::generate();

        $this->service = (new SalaryService())
            ->addRule(new AgeRule())
            ->addRule(new KidsRule())
            ->addRule(new CarRule());
    }

    public function testCalculateAlice()
    {
        $statement = $this->service->calculate($this->employees['Alice']);
        $this->assertEquals(4800, $statement->total);
    }

    public function testCalculateBob()
    {
        $statement = $this->service->calculate($this->employees['Bob']);
        $this->assertEquals(3024, $statement->total);
    }

    public function testCalculateCharlie()
    {
        $statement = $this->service->calculate($this->employees['Charlie']);
        $this->assertEquals(3690, $statement->total);
    }
}
