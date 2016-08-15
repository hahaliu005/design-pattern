<?php
/**
 * 组合模式
 */
abstract class Corp
{
    private $name;
    private $position;
    private $salary;
    private $parent;
    private $children = [];
    public function __construct(string $name, string $position, int $salary)
    {
        $this->name = $name;
        $this->position = $position;
        $this->salary = $salary;
    }

    public function getInfo()
    {
        return [
            'name' => $this->name,
            'position' => $this->position,
            'salary' => $this->salary,
        ];
    }

    public function add(Corp $corp)
    {
        $this->children[] = $corp;
    }

    public function remove(Corp $corp)
    {
        foreach ($this->children as $index => $child) {
            if ($child === $child) {
                unset($this->children[$index]);
            }
        }
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setParent(Corp $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Corp
    {
        return $this->parent;
    }
}

class Leaf extends Corp
{

}

class Branch extends Corp
{

}

$boss = new Branch('bossName', 'boss', 10000);
$manager = new Branch('managerName', 'manager', 1000);
$employ = new Leaf('employName', 'employ', 100);
$employ2 = new Leaf('employ2Name', 'employ', 90);

$manager->add($employ);
$manager->add($employ);

$boss->add($manager);

var_dump($boss->getInfo());
var_dump($boss->getChildren());

var_dump($manager->getInfo());
var_dump($manager->getChildren());

var_dump($employ->getInfo());
var_dump($employ->getChildren());



