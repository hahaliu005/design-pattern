<?php

/**
 * 策略模式示例
 */
interface Calculator
{
    const ADD_SYMBOL = '+';
    const SUB_SYMBOL = '-';
    public function exec(int $a, int $b):int;
}

class Add implements Calculator
{
    public function exec(int $a, int $b):int
    {
        return $a + $b;
    }
}

class Sub implements Calculator
{
    public function exec(int $a, int $b):int
    {
        return $a - $b;
    }
}

class Context
{
    private $cal = null;
    public function __construct(Calculator $cal)
    {
        $this->cal = $cal;
    }

    public function exec(int $a, int $b)
    {
        return $this->cal->exec($a, $b);
    }
}

$a = random_int(1, 10);

$symbols = [Calculator::ADD_SYMBOL, Calculator::SUB_SYMBOL];
$symbol = $symbols[array_rand($symbols)];

$b = random_int(1, 10);

switch ($symbol) {
    case Calculator::ADD_SYMBOL:
        $context = new Context(new Add());
        break;
    case Calculator::SUB_SYMBOL;
        $context = new Context(new Sub());
        break;
}
$result = $context->exec($a, $b);

echo '$a: ' . $a . ' $b: ' . $b . "\n";
echo '$symbol: ' . $symbol . "\n";
echo 'result: ' . $result;

/* output
$a: 5 $b: 9
$symbol: +
result: 14
 */

