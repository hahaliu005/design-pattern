<?php
/**
 * 迭代器模式示例
 */

interface IMyIterator
{
    public function current();
    public function next();
    public function hasNext();
}

class MyIterator implements IMyIterator
{
    private $arr;
    private $index;
    public function __construct(array $arr)
    {
        $this->arr = $arr;
        $this->index = 0;
    }

    public function current()
    {
        return $this->arr[$this->index];
    }
    public function next()
    {
        if (! $this->hasNext()) {
            return null;
        }
        return $this->arr[++ $this->index];
    }
    public function hasNext()
    {
        return isset($this->arr[$this->index + 1]);
    }
}

$array = ['one', 'two', 'three'];
$iter = new MyIterator($array);

echo 'current: ' . $iter->current() . "\n";
echo 'next: ' . $iter->next() . "\n";
echo 'hasNext: ' . $iter->hasNext() . "\n";
echo 'next: ' . $iter->next() . "\n";
echo 'hasNext: ' . (int) $iter->hasNext() . "\n";
echo 'next: ' . $iter->next() . "\n";
