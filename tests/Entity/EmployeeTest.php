<?php

namespace App\Tests\Entity;

use App\DataFixtures\EmployeeFixtures;
use PHPUnit\Framework\TestCase;

/**
 * Test for Employee Entity
 */
class EmployeeTest extends TestCase
{
    public $employees;

    protected function setUp()
    {
        // Get predefined employees
        $this->employees = EmployeeFixtures::generate();
    }

    /**
     * Test getAge function
     */
    public function testGetAge()
    {
        $this->assertEquals(26, $this->employees['Alice']->getAge());
        $this->assertEquals(52, $this->employees['Bob']->getAge());
        $this->assertEquals(36, $this->employees['Charlie']->getAge());
    }
}
