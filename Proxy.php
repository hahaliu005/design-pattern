<?php
/**
 * 代理模式
 */

interface IPlayer
{
    public function login();
    public function killBoss();
    public function upgrade();
}

class Player implements IPlayer
{
    private $playerName;
    public function __construct($playerName)
    {
        $this->playerName = $playerName;
    }

    public function login()
    {
        echo "Player {$this->playerName} login\n";
    }
    
    public function killBoss()
    {
        echo "Player {$this->playerName} kill boss\n";
    }
    
    public function upgrade()
    {
        echo "Player {$this->playerName} upgrade\n";
    }
    
    public function __get($attr)
    {
        if (property_exists($this, $attr)) {
            return $this->$attr;
        } else {
            return null;
        }
    }
}


class PlayerProxy
{
    private $player;
    public function __construct($playerName)
    {
        $this->player = new Player($playerName);
    }
    
    public function playGame()
    {
        $this->login();
        $this->killBoss();
        $this->upgrade();
    }
    
    public function __call($name, $arguments)
    {
        if (method_exists($this->player, $name)) {
            $this->beforeCall($name);
            $result = call_user_func_array([$this->player, $name], $arguments);
            $this->afterCall($name);
            return $result;
        }
    }
    
    protected function beforeCall($name)
    {
        switch ($name) {
            case 'login':
                echo "Player {$this->player->playerName} want to login\n";
            default:
                // donothing
        }
    }
    
    protected function afterCall($name)
    {
        switch ($name) {
            case 'killBoss':
                echo "Player {$this->player->playerName} killed a boss\n";
            default:
                // donothing
        }
    }
}

$playerProxy = new playerProxy("zhangsan");
$playerProxy->playGame();
echo "====\n";
$playerProxy2 = new playerProxy("lisi");
$playerProxy2->playGame();

/** output
 *
Player zhangsan want to login
Player zhangsan login
Player zhangsan kill boss
Player zhangsan killed a boss
Player zhangsan upgrade
===
Player lisi want to login
Player lisi login
Player lisi kill boss
Player lisi killed a boss
Player lisi upgrade
 */
