<?php
/**
 * 备忘录模式
 */

class Writer
{
    private $content = '';
    private $history;
    public function __construct(WriteHistory $history)
    {
        $this->history = $history;
    }

    public function write($content)
    {
        $this->history->appendContent($this->content);
        $this->content .= $content;
    }

    public function rollBack()
    {
        $this->content = $this->history->backContent();
    }

    public function getContent()
    {
        return $this->content;
    }
}

class WriteHistory
{
    private $historyLimit = 5;
    private $contents = [];

    public function appendContent($content)
    {
        if (count($this->contents) >= $this->historyLimit) {
            array_shift($this->contents);
        }
        $this->contents[] = $content;
    }

    public function backContent()
    {
        return array_pop($this->contents);
    }
}

$writer = new Writer(new WriteHistory());

$writer->write('one');
$writer->write('two');
$writer->write('three');
$writer->write('four');
$writer->write('five');
$writer->write('six');
echo $writer->getContent();
echo "\n";
echo "after rollback 1 step:\n";
$writer->rollBack();
echo $writer->getContent();
/* output
onetwothreefourfivesix
after rollback 1 step:
onetwothreefourfive
*/

