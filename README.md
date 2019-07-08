# Realforce coding test

## Description
Application which can calculate the salary of employees.
We need to have an expandable system of bonuses or deductions.

- Country Tax for salaries is 20%
- If an employee older than 50 we want to add 7% to his salary
- If an employee has more than 2 kids we want to decrease his Tax by 2%
- If an employee wants to use a company car we need to deduct $500

## Test cases
- Alice is 26 years old, she has 2 kids and her salary is $6000
- Bob is 52, he is using a company car and his salary is $4000
- Charlie is 36, he has 3 kids, company car and his salary is $5000

## Architecture
- `Employee` entity
    - Name: string, not null
    - Salary: integer, not null
    - Birthday: integer, unix timestamp, not null
    - Kids: integer, default=0
    - UsesCar: boolean integer (0 = false, 1 = true), default=0
- `Statement` class
    - modifiers: list of bonus & deduction values
    - subTotal: Sub Total value
    - taxDiscounts: list of Tax discounts
    - taxValue: resultig Tax value
    - total: resulting value (equals subTotal - taxValue)
- `Rule` interface
    - Describes function `apply(Employee $employee, Statement $statement):Statement` which should return updated `Statement` for given `Employee`
- Specific `Rule`s
    - `AgeRule` class
    - `KidsRule` class
    - `CarRule` class
- `SalaryService`
    - Initializes a list of `Rule`s
    - Implements function `calculate(Employee $employee):Statement` which returns `Statement` object for given `Employee` based on list of `Rule`s

## Roadmap
- [x] Create `Employee` entity
- [x] Create fixtures for test cases
- [x] Implement unit test for `Employee` entity
- [x] Create `Statement` class
- [x] Create rules
- [x] Implement unit tests for rules
- [x] Create `SalaryService`
- [x] Implement unit tests for `SalaryService`
- [x] Create Web example

## How to install

1. You will need Docker v18 or higher
1. And docker-compose v1.24 or higher
1. Clone this repository and navigate to the project folder
1. Run `docker-compose up`
1. Open http://localhost:8888 in your browser

## How to tests
Run `docker-compose run --rm composer ./bin/phpunit`

## How to expand
1. Create new rule class that implements `App\Service\Salary\RuleInterface`
2. Implement your logic inside `apply` function. Call `Statement::addModifier` and `Statement::addTaxDiscount` methods when needed.
3. Create `App\Service\Salary\SalaryService` instance (or inject it) in your main code (i.e. in controller). Configure it by adding your rule to it `$service->addRule(new MyRule())`.
4. You can chain multiple rules:  
```php
$service
    ->addRule(new AgeRule())
    ->addRule(new KidsRule())
    ->addRule(new CarRule());
```
5. Call `SalaryService::calculate` method to get the statement for employee
