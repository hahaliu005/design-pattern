<?php

class mail
{
    protected $name;
    protected $content = "The content";
    public function __construct()
    {
        echo "Mail construct.\n";
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function send()
    {
        echo "Mail send: {$this->name} => {$this->content}\n";
    }
    
    public function __clone()
    {
        echo "Called clone.";
    }
}

$mail = new mail();
$sendList = ['zhangsan', 'lisi', 'wanger'];

foreach ($sendList as $name) {
    $singleMail = clone $mail;
    $singleMail->setName($name);
    $singleMail->send();
}

/* output
Mail construct.
Called clone.Mail send: zhangsan => The content
Called clone.Mail send: lisi => The content
Called clone.Mail send: wanger => The content
*/



