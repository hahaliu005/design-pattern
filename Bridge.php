<?php
/**
 * 桥梁模式
 */

abstract class Product
{
    public abstract function beProducted();
    public abstract function beSelled();
}

class House extends Product
{
    public function beProducted()
    {
        echo "House be producted\n";
    }
    public function beSelled()
    {
        echo "House be selled\n";
    }
}

class IPod extends Product
{
    public function beProducted()
    {
        echo "IPod be producted\n";
    }

    public function beSelled()
    {
        echo "IPod be selled\n";
    }
}

abstract class Corp
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function makeMoney()
    {
        $this->product->beProducted();
        $this->product->beSelled();
    }
}

class HouseCorp extends Corp
{
    public function __construct(House $house)
    {
        parent::__construct($house);
    }

    public function makeMoney()
    {
        parent::makeMoney();
        echo "House Corp make money\n";
    }
}

class ShanZhaiCorp extends Corp
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function makeMoney()
    {
        parent::makeMoney();
        echo "ShanZhai corp make money\n";
    }
}

$house = new House();
$houseCorp = new HouseCorp($house);
$houseCorp->makeMoney();

$shanZhaiCorp = new ShanZhaiCorp(new IPod());
$shanZhaiCorp->makeMoney();

/* output
House be producted
House be selled
House Corp make money
IPod be producted
IPod be selled
ShanZhai corp make money
*/
