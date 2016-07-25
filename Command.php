<?php
/**
 * 命令模式
 */
abstract class Group
{
    public abstract function find();
    public abstract function add();
    public abstract function delete();
    public abstract function change();
    public abstract function plan();
}

class RequirementGroup extends Group
{
    public function find()
    {
        echo "Find requirement group\n";
    }
    
    public function add()
    {
        echo "Requirement group add\n";
    }
    
    public function delete()
    {
        echo "Requirement group delete\n";
    }
    
    public function change()
    {
        echo "Requirement group change\n";
    }
    
    public function plan()
    {
        echo "Requirement group plan\n";
    }
}

class PageGroup extends Group
{
    public function find()
    {
        echo "Find Page group\n";
    }

    public function add()
    {
        echo "Page group add\n";
    }

    public function delete()
    {
        echo "Page group delete\n";
    }

    public function change()
    {
        echo "Page group change\n";
    }

    public function plan()
    {
        echo "Page group plan\n";
    }
}

class CodeGroup extends Group
{
    public function find()
    {
        echo "Find Code group\n";
    }

    public function add()
    {
        echo "Code group add\n";
    }

    public function delete()
    {
        echo "Code group delete\n";
    }

    public function change()
    {
        echo "Code group change\n";
    }

    public function plan()
    {
        echo "Code group plan\n";
    }
}

abstract class Command
{
    protected $rg;
    protected $pg;
    protected $cg;
    public function __construct()
    {
        $this->rg = new RequirementGroup();
        $this->pg = new PageGroup();
        $this->cg = new CodeGroup();
    }

    abstract public function execute();
}

class AddRequirementCommand extends Command
{
    public function execute()
    {
        $this->rg->find();
        $this->rg->add();
        $this->rg->plan();
    }
}

class DeletePageCommand extends Command
{
    public function execute()
    {
        $this->pg->find();
        $this->rg->delete();
        $this->rg->plan();
    }
}

class Invoker
{
    protected $command;
    
    public function setCommand(Command $command)
    {
        $this->command = $command;
    }
    
    public function action()
    {
        $this->command->execute();
    }
}

$invoker = new Invoker();

$command = new AddRequirementCommand();
$invoker->setCommand($command);
$invoker->action();

$command = new DeletePageCommand();
$invoker->setCommand($command);
$invoker->action();

/*
Find requirement group
Requirement group add
Requirement group plan
Find Page group
Requirement group delete
Requirement group plan
*/
