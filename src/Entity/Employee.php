<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $salary;

    /**
     * @ORM\Column(type="integer")
     */
    private $birthday;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $kids = 0;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $usesCar = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getBirthday(): ?int
    {
        return $this->birthday;
    }

    public function setBirthday(int $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return int Returns Employee's age
     */
    public function getAge(): int
    {
        $now = new DateTime();
        $then = (new DateTime())->setTimeStamp($this->birthday);
        $diff = $now->diff($then);
        return $diff->y;
    }

    public function getKids(): ?int
    {
        return $this->kids;
    }

    public function setKids(int $kids): self
    {
        $this->kids = $kids;

        return $this;
    }

    public function getUsesCar(): ?int
    {
        return $this->usesCar;
    }

    public function setUsesCar(int $usesCar): self
    {
        $this->usesCar = $usesCar;

        return $this;
    }
}
