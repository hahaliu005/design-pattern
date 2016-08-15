<?php
/**
 * 门面模式
 */

class LetterProcess
{
    public function writeContext(string $context)
    {
        echo "write context\n";
    }

    public function fillEnvelope(string $address)
    {
        echo "fill evelope\n";
    }

    public function letterIntoEnvelope()
    {
        echo "letter into envelope\n";
    }

    public function sendLetter()
    {
        echo "send letter\n";
    }
}

class postOffice
{
    private $letterProcess;
    public function __construct(LetterProcess $letterProcess)
    {
        $this->letterProcess = $letterProcess;
    }

    public function sendLetter(string $context, string $address)
    {
        $this->letterProcess->writeContext($context);
        $this->letterProcess->fillEnvelope($address);
        $this->letterProcess->letterIntoEnvelope();
        $this->letterProcess->sendLetter();
    }
}

$postOffice = new postOffice(new LetterProcess());

$postOffice->sendLetter('context', 'address');

/* output
write context
fill evelope
letter into envelope
send letter
*/