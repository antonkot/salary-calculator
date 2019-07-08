<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    /**
     * @return array Returns an array of predefined [name => Employee] pairs
     */
    public static function generate()
    {
        $Alice = new Employee();
        $Alice->setName('Alice');
        $Alice->setBirthday(strtotime("26 years ago"));
        $Alice->setKids(2);
        $Alice->setSalary(6000);

        $Bob = new Employee();
        $Bob->setName('Bob');
        $Bob->setBirthday(strtotime("52 years ago"));
        $Bob->setUsesCar(1);
        $Bob->setSalary(4000);

        $Charlie = new Employee();
        $Charlie->setName('Charlie');
        $Charlie->setBirthday(strtotime("36 years ago"));
        $Charlie->setKids(3);
        $Charlie->setUsesCar(1);
        $Charlie->setSalary(5000);

        return [
            'Alice' => $Alice,
            'Bob' => $Bob,
            'Charlie' => $Charlie
        ];
    }

    public function load(ObjectManager $manager)
    {
        foreach (static::generate() as $employee) {
            $manager->persist($employee);
        }

        $manager->flush();
    }
}
