<?php
/**
 * 状态模式
 */
abstract class LiftState
{
    protected $context;
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public abstract function open();
    public abstract function close();
    public abstract function run();
    public abstract function stop();
}

class Context
{
    public static $openningState;
    public static $closeingState;
    public static $runningState;
    public static $stoppingState;

    private $liftState;
    public function __construct()
    {
        self::$openningState = new OpenningState($this);
        self::$closeingState = new ClosingState($this);
        self::$runningState = new RunningState($this);
        self::$stoppingState = new StoppingState($this);
    }


    public function getLiftState()
    {
        return $this->liftState;
    }

    public function setLiftState(LiftState $liftState)
    {
        $this->liftState = $liftState;
    }

    public function open()
    {
        $this->liftState->open();
    }

    public function close()
    {
        $this->liftState->close();
    }

    public function run()
    {
        $this->liftState->run();
    }

    public function stop()
    {
        $this->liftState->stop();
    }

}

class OpenningState extends LiftState
{
    public function close()
    {
        $this->context->setLiftState(Context::$closeingState);
        $this->context->getLiftState()->close();
    }

    public function open()
    {
        echo "openning\n";
    }

    public function run()
    {
        // do nothing
    }

    public function stop()
    {
        // do nothing
    }
}

class ClosingState extends LiftState
{
    public function close()
    {
        echo "closing\n";
    }

    public function open()
    {
        $this->context->setLiftState(Context::$openningState);
        $this->context->getLiftState()->open();
    }

    public function run()
    {
        $this->context->setLiftState(Context::$runningState);
        $this->context->getLiftState()->run();
    }

    public function stop()
    {
        $this->context->setLiftState(Context::$stoppingState);
        $this->context->getLiftState()->stop();
    }
}

class RunningState extends LiftState
{
    public function close()
    {
        // do nothing
    }

    public function open()
    {
        // do nothing
    }

    public function run()
    {
        echo "running\n";
    }

    public function stop()
    {
        $this->context->setLiftState(Context::$stoppingState);
        $this->context->getLiftState()->stop();
    }

}

class StoppingState extends LiftState
{
    public function close()
    {
        // do nothing
    }

    public function open()
    {
        $this->context->setLiftState(Context::$openningState);
        $this->context->getLiftState()->open();
    }

    public function run()
    {
        $this->context->setLiftState(Context::$runningState);
        $this->context->getLiftState()->run();
    }

    public function stop()
    {
        echo "stopping\n";
    }
}

$context = new Context();
$context->setLiftState(new ClosingState($context));

$context->open();
$context->close();
$context->run();
$context->stop();

/* output
openning
closing
running
stopping
*/

