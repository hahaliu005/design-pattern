<?php
/**
 * 访问者模式
 */

class Visitor
{
    public function visit($employee)
    {
        $employee->getInfo();
    }
}

class Employee
{
    private $name;
    private $salary;
    public function __construct(string $name, int $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getInfo()
    {
        echo "Employee info name:$this->name salary: $this->salary\n";
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visit($this);
    }
}

class Manager
{
    private $name;
    private $salary;
    public function __construct(string $name, int $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getInfo()
    {
        echo "Manager info name:$this->name salary: $this->salary\n";
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visit($this);
    }
}

$employee = new Employee('employName', '1000');
$manager = new Manager('managerName', '10000');

$employee->accept(new Visitor());
$manager->accept(new Visitor());

/* output
Employee info name:employName salary: 1000
Manager info name:managerName salary: 10000
*/
