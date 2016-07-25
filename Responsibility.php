<?php

/**
 * 责任鏈模式
 */

abstract class Handler
{
    const FATHER_LEVEL = 1;
    const HUSBAND_LEVEL = 2;
    const SON_LEVEL = 3;
    
    protected $level;
    protected $nextHandler;
    
    public function __construct(int $level, Handler $nextHandler = null)
    {
        $this->level = $level;
        $this->nextHandler = $nextHandler;
    }
    
    public function handleMessage(Woman $woman)
    {
        if ($this->level == $woman->getType()) {
            $this->response($woman);
        } elseif ($this->nextHandler !== null) {
            $this->nextHandler->handleMessage($woman);
        } else {
            echo "Do not have handler to handle, aggree\n";
        }
    }
    
    public function setNext(Handler $handler)
    {
        $this->nextHandler = $handler;
    }
    
    abstract public function response(Woman $woman);
}

class Father extends Handler
{
    public function __construct()
    {
        parent::__construct(static::FATHER_LEVEL);
    }
    
    public function response(Woman $woman)
    {
        echo "Woman ask for father\n";
        echo $woman->getRequest();
        echo "Father aggree it\n";
    }
}

class Husband extends Handler
{
    public function __construct()
    {
        parent::__construct(static::HUSBAND_LEVEL);
    }
    
    public function response(Woman $woman)
    {
        echo "Woman ask for husband\n";
        echo $woman->getRequest();
        echo "Husband aggree it\n";
    }
}

class Son extends Handler
{
    public function __construct()
    {
        parent::__construct(static::SON_LEVEL);
    }
    
    public function response(Woman $woman)
    {
        echo "Woman ask for son\n";
        echo $woman->getRequest();
        echo "Son aggree it\n";
    }
}


class Woman
{
    private $type;
    private $request;
    
    public function __construct( int $type, string $request)
    {
        $this->type = $type;
        switch ($type) {
            case Handler::FATHER_LEVEL:
                $this->request = "Daughter's request is:" . $request;
                break;
            case Handler::HUSBAND_LEVEL:
                $this->request = "Wife's request is:" . $request;
                break;
            case Handler::SON_LEVEL:
                $this->request = "Mother's request is:" . $request;
                break;
        }
    }
    
    public function getType() : int
    {
        return $this->type;
    }
    
    public function getRequest() : string
    {
        return $this->request;
    }
}

$father = new Father();
$husband = new Husband();
$son = new Son();

$father->setNext($husband);
$husband->setNext($son);

foreach(range(1, 5) as $i) {
    $woman = new Woman(random_int(Handler::FATHER_LEVEL,Handler::SON_LEVEL), "I want to shopping\n");
    $father->handleMessage($woman);
}

/*
Woman ask for father
Daughter's request is:I want to shopping
Father aggree it
Woman ask for husband
Wife's request is:I want to shopping
Husband aggree it
Woman ask for husband
Wife's request is:I want to shopping
Husband aggree it
Woman ask for son
Mother's request is:I want to shopping
Son aggree it
Woman ask for son
Mother's request is:I want to shopping
Son aggree it
*/
