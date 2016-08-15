<?php
/**
 * 享元模式
 */

class SignInfo
{
    private $id;
    private $location;
    private $subject;
    private $postAddress;
    public function __get($name)
    {
        $this->$name;
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}

class SignInfo4Pool extends SignInfo
{
    private $key;
    public function __construct(string $key)
    {
        $this->key = $key;
    }
}

class SignInfoFactory
{
    private static $pools = [];
    public static function getSignInfo(string $key)
    {
        if (key_exists($key, self::$pools)) {
            echo 'exist: ' . $key . "\n";
            return self::$pools[$key];
        } else {
            echo 'new : ' . $key . "\n";
            $pool = new SignInfo4Pool($key);
            self::$pools[$key] = $pool;
            return $pool;
        }
    }
}

for ($i = 0; $i < 2; $i++) {
    $subject = 'subject' . $i;
    for ($j = 0; $j < 2; $j ++) {
        $key = $subject . 'local' . $j;
        SignInfoFactory::getSignInfo($key);
    }
}
SignInfoFactory::getSignInfo('subject1local1');

/* output
new : subject0local0
new : subject0local1
new : subject1local0
new : subject1local1
exist: subject1local1
*/
