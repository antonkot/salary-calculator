<?php

namespace App\Controller;

use App\DataFixtures\EmployeeFixtures;
use App\Service\Salary\Rules\AgeRule;
use App\Service\Salary\Rules\CarRule;
use App\Service\Salary\Rules\KidsRule;
use App\Service\Salary\SalaryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Example contoller
 */
class AppController extends AbstractController
{
    /**
     * Uses Salary Service and Rules and renders the page
     */
    public function index(SalaryService $service)
    {
        $service
            ->addRule(new AgeRule())
            ->addRule(new KidsRule())
            ->addRule(new CarRule());

        $data = [];

        // Calculate all employees
        foreach (EmployeeFixtures::generate() as $employee) {
            $data[] = [
                'employee' => $employee,
                'statement' => $service->calculate($employee),
            ];
        }

        // Render the data
        return $this->render('index.html.twig', [
            'country_tax' => SalaryService::COUNTRY_TAX,
            'data' => $data,
        ]);
    }
}
