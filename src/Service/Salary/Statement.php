<?php

namespace App\Service\Salary;

/**
 * Statement class
 */
class Statement
{
    /**
     * @var array
     * List of salary value modifiers
     * [description => value] pairs
     */
    private $modifiers = [];

    /**
     * @var float
     * Sub Total Salary value
     */
    public $subTotal;

    /**
     * @var array
     * List of Tax Discounts
     * [description => value] pairs
     */
    private $taxDiscounts = [];

    /**
     * @var float
     * Resulting tax value
     */
    public $taxValue;

    /**
     * @var float
     * Resulting total value
     */
    public $total;

    /**
     * Returns a map of [description => value] pairs
     * @return array
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }

    /**
     * Returns a map of [description => value] pairs
     * @return array
     */
    public function getTaxDiscounts()
    {
        return $this->taxDiscounts;
    }

    /**
     * Adds modifier to the list
     * @param string $description Description of modifier
     * @param float $value Value of modifier
     * @return void
     */
    public function addModifier(string $description, float $value)
    {
        $this->modifiers[$description] = $value;
    }

    /**
     * Adds tax discount to the list
     * @param string $description Description of tax discount
     * @param float $value Value of tax discount
     * @return void
     */
    public function addTaxDiscount(string $description, float $value)
    {
        $this->taxDiscounts[$description] = $value;
    }
}
