<?php
/**
 * 解释器模式
 */

abstract class Expression
{
    public abstract function interpreter(array $var): int;
}

class VarExpression extends Expression
{
    private $key;
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function interpreter(array $var): int
    {
        return $var[$this->key];
    }
}

abstract class SymbolExpression extends Expression
{
    protected $left;
    protected $right;
    public function __construct(Expression $left, Expression $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

}

class AddExpress extends SymbolExpression
{
    public function interpreter(array $var): int
    {
        return $this->left->interpreter($var) + $this->right->interpreter($var);
    }
}

class SubExpression extends SymbolExpression
{
    public function interpreter(array $var): int
    {
        return $this->left->interpreter($var) - $this->right->interpreter($var);
    }
}

class Calculator
{
    private $expression;
    private $expArr;
    public function __construct(string $expStr)
    {
        $this->expArr = explode(' ', $expStr);

        $left = null;
        $right = null;
        $stack = [];
        for ($i = 0; $i < count($this->expArr); $i++) {
            switch ($this->expArr[$i]) {
                case '+':
                    $left = array_pop($stack);
                    $right = new VarExpression(++$i);
                    array_push($stack, new AddExpress($left, $right));
                    break;
                case '-':
                    $left = array_pop($stack);
                    $right = new VarExpression(++$i);
                    array_push($stack, new SubExpression($left, $right));
                    break;
                default:
                    array_push($stack, new VarExpression($i));
            }
        }
        $this->expression = array_pop($stack);
    }

    public function run()
    {
        return $this->expression->interpreter($this->expArr);
    }
}

$expStr = '12 + 45';
$calculator = new Calculator($expStr);
echo "$expStr => " . $calculator->run() . "\n";

$expStr = '94 + 32 - 76';
$calculator = new Calculator($expStr);
echo "$expStr => " . $calculator->run() . "\n";

/*
12 + 45 => 57
94 + 32 - 76 => 50
*/
