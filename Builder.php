<?php

/**
 * 建造者模式
 */

abstract class CarModel
{
    protected $sequence = [];
    
    abstract protected function start();
    abstract protected function stop();
    abstract protected function alarm();
    abstract protected function engineBoom();
    
    public function __construct($sequence)
    {
        $this->sequence = $sequence;
    }
    
    final public function setSequence(array $sequence)
    {
        $this->sequence = $sequence;
    }
    
    final public function run()
    {
        foreach ($this->sequence as $funName) {
            if (method_exists($this, $funName)) {
                $this->$funName();
            }
        }
    }
}

class BMWModel extends CarModel
{
    protected function start()
    {
        echo "BMW car start.\n";
    }
    protected function stop()
    {
        echo "BMW car stop.\n";
    }
    protected function alarm()
    {
        echo "BMW car alarm.\n";
    }
    protected function engineBoom()
    {
        echo "BMW car engine boom.\n";
    }
}

class BenzModel extends CarModel
{
    protected function start()
    {
        echo "Benz car start.\n";
    }
    protected function stop()
    {
        echo "Benz car stop.\n";
    }
    protected function alarm()
    {
        echo "Benz car alarm.\n";
    }
    protected function engineBoom()
    {
        echo "Benz car engine boom.\n";
    }
}

abstract class CarBuilder
{
    protected $sequence = [];
    public function __construct($sequence = [])
    {
        $this->sequence = $sequence;
    }
    public function setSqeuence(array $sequence)
    {
        $this->sequence = $sequence;
    }

    abstract public function getCarModel(): CarModel;

}

class BMWBuilder extends CarBuilder
{
    public function getCarModel(): CarModel
    {
        return new BMWModel($this->sequence);
    }
}

class BenzBuilder extends CarBuilder
{
    public function getCarModel(): CarModel
    {
        return new BenzModel($this->sequence);
    }
}

class Director
{
    protected $sequence = [];
    protected $BMWBuilder;
    protected $BenzBuilder;
    
    public function __construct()
    {
        $this->BMWBuilder = new BMWBuilder();
        $this->BenzBuilder = new BenzBuilder();
    }

    public function getABMWModel(): CarModel
    {
        $sequence = ['start', 'alarm', 'stop'];
        $this->BMWBuilder->setSqeuence($sequence);
        return $this->BMWBuilder->getCarModel();
    }
    public function getBBMWModel(): CarModel
    {
        $sequence = ['alarm', 'alarm', 'start'];
        $this->BMWBuilder->setSqeuence($sequence);
        return $this->BMWBuilder->getCarModel();
    }
    public function getABenzModel(): CarModel
    {
        $sequence = ['engineBoom', 'stop', 'start'];
        $this->BenzBuilder->setSqeuence($sequence);
        return $this->BenzBuilder->getCarModel();
    }
    public function getBBenzModel(): CarModel
    {
        $sequence = ['engineBoom', 'start', 'stop'];
        $this->BenzBuilder->setSqeuence($sequence);
        return $this->BenzBuilder->getCarModel();
    }
}

// 不同的建造者建造出不同种类的汽车
$sequence = ['start', 'alarm', 'stop'];
$BMWBuilder = new BMWBuilder($sequence);
$BMWModel = $BMWBuilder->getCarModel();
$BMWModel->run();
echo "========\n";
$sequence = ['stop', 'start', 'alarm', 'engineBoom'];
$BenzBuilder = new BenzBuilder($sequence);
$BenzModel = $BenzBuilder->getCarModel();
$BenzModel->run();
echo "============\n";
echo "============\n";

// 使用总导演来产生各种不同种类的汽车
$director = new Director();
echo "ABMW run==>\n";
$director->getABMWModel()->run();
echo "BBMW run==>\n";
$director->getBBMWModel()->run();
echo "ABenz run==>\n";
$director->getABenzModel()->run();
echo "BBenz run==>\n";
$director->getBBenzModel()->run();
