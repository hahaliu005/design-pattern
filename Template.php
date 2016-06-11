<?php
/**
 * 模板方法模式
 */


abstract class HummerModel
{
    protected $isAlarm = true;
    
    abstract public function start();
    abstract public function stop();
    abstract public function alarm();
    abstract public function engineBoom();
    // 抽象方法中的统一方法应该为final, 不应该再让子类继承
    final public function run()
    {
        $this->start();
        $this->engineBoom();
        if ($this->isAlarm) {
            $this->alarm();
        }
        $this->stop();
    }
}

class HummerH1Model extends HummerModel
{
    public function __construct()
    {
        // 初始化时定义自己的属性, 如是否有喇叭
        $this->isAlarm = true;
    }

    public function start()
    {
        echo "HummerH1 start\n";
    }
    public function stop()
    {
        echo "HummerH1 stop\n";
    }
    public function alarm()
    {
        echo "HummerH1 alarm\n";
    }
    public function engineBoom()
    {
        echo "HummerH1 engineBoom\n";
    }
}

class HummerH2Model extends HummerModel
{
    public function __construct()
    {
        // 没喇叭了, 就不会去执行alarm()了
        $this->isAlarm = false;
    }
    
    public function start()
    {
        echo "HummerH2 start\n";
    }
    public function stop()
    {
        echo "HummerH2 stop\n";
    }
    public function alarm()
    {
        echo "HummerH2 alarm\n";
    }
    public function engineBoom()
    {
        echo "HummerH2 engineBoom\n";
    }
}

$hummerH1 = new HummerH1Model();
$hummerH1->run();
echo "=====\n";
$hummerH2 = new HummerH2Model();
$hummerH2->run();

/** output
HummerH1 engineBoom
HummerH1 alarm
HummerH1 stop
=====
HummerH2 start
HummerH2 engineBoom
HummerH2 stop
*/
