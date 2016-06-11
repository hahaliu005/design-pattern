<?php

/**
 * 单例模式
 */

class Singleton
{
    private static $instance = null;
    
    private function __construct()
    {
    }
    
    public static function getInstance(): self
    {
        /**
         * 在极限情况下, 当两个以下线程都跑到下面这条判断语句时, 
         * 还是很有可能由于判断均为true, 导致生成了多个实例
         */
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private $runCount = 0;
    public function run()
    {
        $this->runCount++;
        
        echo "hello run Count: {$this->runCount}\n";
    }
}

$instance = Singleton::getInstance();

$instance->run();
$instance->run();

/**
 * 有上限的单例模式
 */

class multiSingleton
{
    // 设定可以实例多少个此类
    private static $maxCount = 3;
    
    // 保存类实例的列表
    private static $instanceList = [];
    
    private $offset;
    
    private function __construct($offset)
    {
        $this->offset = $offset;
        echo "Generate the ${offset}th instance\n";
    }

    /**
     * 如果生成的实例已达到上限, 会随机返回一个实例, 如果还未达到上限, 将会继续生成实例并返回
     * @return mixed|multiSingleton
     */
    public static function getInstance()
    {
        $instanceCount = count(self::$instanceList);
        
        if ($instanceCount < self::$maxCount) {
            return self::$instanceList[$instanceCount] = new self($instanceCount);
        } else {
            return self::$instanceList[random_int(0, self::$maxCount - 1)];
        }
    }
    
    public function sayHello()
    {
        echo $this->offset . " say hello\n";
    }
}

multiSingleton::getInstance()->sayHello();
multiSingleton::getInstance()->sayHello();
multiSingleton::getInstance()->sayHello();
multiSingleton::getInstance()->sayHello();
multiSingleton::getInstance()->sayHello();
multiSingleton::getInstance()->sayHello();

/*output first
Generate the 0th instance
0 say hello
Generate the 1th instance
1 say hello
Generate the 2th instance
2 say hello
*/
/* then it will output offset randomly
2 say hello
0 say hello
0 say hello
*/
