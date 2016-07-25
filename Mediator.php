<?php

/**
 * 中介者模式
 */
class Mediator
{
    private $_purchase;
    private $_sale;
    private $_stock;
    
    public function __construct()
    {
        $this->_purchase = new Purchase($this);
        $this->_sale = new Sale($this);
        $this->_stock = new Stock($this);
    }
    
    public function execute(string $command, ...$args)
    {
        switch ($command) {
            case 'buy':
                $this->buyComputer($args[0]);
                break;
            case 'sell':
                $this->sellComputer($args[0]);
                break;
            case 'offsell':
                $this->offSell();
                break;
            case 'clear':
                $this->clearStock();
                break;
            default:
                echo "Unknow command : $command\n";
        }
    }
    
    private function buyComputer(int $number)
    {
        $sale = $this->_sale->getSellStatus();
        if ($sale < 80) {
            $number = $number / 2;
        }
        echo "Buy computer $number\n";
        $this->_stock->increase($number);
    }
    
    private function sellComputer(int $number)
    {
        if ($this->_stock->getStockNumber() < $number) {
            $this->_purchase->buyIBMComputer($number);
        }
        $this->_stock->decrease($number);
    }
    
    private function offSell()
    {
        echo "Offsell IBM computer : {$this->_stock->getStockNumber()}\n";
    }
    
    private function clearStock()
    {
        $this->_sale->offSale();
        $this->_purchase->refuseBuyIBM();
    }

}

class AbstractColleague
{
    protected $_mediator;
    public function __construct(Mediator $mediator)
    {
        $this->_mediator = $mediator;
    }
}

class Purchase extends AbstractColleague
{
    public function buyIBMComputer(int $number)
    {
        $this->_mediator->execute('buy', $number);
    }
    
    public function refuseBuyIBM()
    {
        echo "Do not buy IBM any more\n";
    }
}

class Stock extends AbstractColleague
{
    private $_computerNum = 100;
    
    public function increase(int $number)
    {
        $this->_computerNum += $number;
        echo "Increase computer : $number\n";
    }
    
    public function decrease(int $number)
    {
        $this->_computerNum -= $number;
        echo "Decrease computer : $number\n";
    }
    
    public function getStockNumber() : int
    {
        return $this->_computerNum;
    }
    
    public function clearStock()
    {
        echo "Clean stock : $this->_computerNum\n";
        $this->_mediator->execute('clear');
    }
}

class Sale extends AbstractColleague
{
    public function sellIBMComputer(int $number)
    {
        $this->_mediator->execute('sell', $number);
        echo "Sell IBM computer : $number\n";
    }
    
    public function getSellStatus()
    {
        $saleStatus = random_int(1, 100);
        echo "The sale status is : $saleStatus\n";
        return $saleStatus;
    }
    
    public function offSale()
    {
        $this->_mediator->execute('offsell');
        echo "Off sale the computer\n";
    }
}

$mediator = new Mediator();

echo "----For purchase computer\n";
$mediator->execute('buy', 100);

echo "----For sale computer\n";
$mediator->execute('sell', 120);
$mediator->execute('sell', 120);

echo "----For Stock clear\n";
$mediator->execute('clear');

/* output
----For purchase computer
The sale status is : 93
Buy computer 100
Increase computer : 100
----For sale computer
Decrease computer : 120
The sale status is : 26
Buy computer 60
Increase computer : 60
Decrease computer : 120
----For Stock clear
Offsell IBM computer : 20
Off sale the computer
Do not buy IBM any more
*/
