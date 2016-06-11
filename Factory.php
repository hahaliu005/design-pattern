<?php

/**
 * 工厂模式
 */

interface Human
{
    public function color();
    public function talk();
}


class HumanFactory
{
    const HUMAN_TYPE_WHITE = 0;
    const HUMAN_TYPE_YELLOW = 1;
    const HUMAN_TYPE_BLACK = 2;
    
    public static function createHuman($type): Human
    {
        switch ($type) {
            case self::HUMAN_TYPE_WHITE:
                return new WhiteHuman();
                break;
            case self::HUMAN_TYPE_YELLOW:
                return new YellowHuman();
                break;
            case self::HUMAN_TYPE_BLACK:
                return new BlackHuman();
                break;
            default:
                throw new Exception('Can not find the human type of:' . $type);
                break;
        }
    }
}

class WhiteHuman implements Human
{
    public function __construct()
    {
        echo "A white human created!\n";
    }

    public function color()
    {
        echo "The white human color is white.\n";
    }
    public function talk()
    {
        echo "The white human speaking.\n";
    }
}
class YellowHuman implements Human
{
    public function __construct()
    {
        echo "A yellow human created!\n";
    }
    public function color()
    {
        echo "The yellow human color is yellow.\n";
    }
    public function talk()
    {
        echo "The yellow human speaking.\n";
    }
}
class BlackHuman implements Human
{
    public function __construct()
    {
        echo "A black human created!\n";
    }
    public function color()
    {
        echo "The black human color is black.\n";
    }
    public function talk()
    {
        echo "The black human speaking.\n";
    }
}

$whiteHuman = HumanFactory::createHuman(HumanFactory::HUMAN_TYPE_BLACK);
$whiteHuman->color();
$whiteHuman->talk();

$yellowHuman = HumanFactory::createHuman(HumanFactory::HUMAN_TYPE_YELLOW);
$yellowHuman->color();
$yellowHuman->talk();

$blackHuman = HumanFactory::createHuman(HumanFactory::HUMAN_TYPE_BLACK);
$blackHuman->color();
$blackHuman->talk();
