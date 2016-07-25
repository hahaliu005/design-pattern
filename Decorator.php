<?php

class SchoolReport
{
    public function report()
    {
        echo "This is the score report\n";
    }
    
    public function sign(string $name)
    {
        echo "The sign is: $name\n";
    }
}

class Decorator extends SchoolReport
{
    private $schoolReport;
    
    public function __construct(SchoolReport $report)
    {
        $this->schoolReport = $report;
    }
    
    public function report()
    {
        $this->schoolReport->report();
    }
    
    public function sign(string $name)
    {
        $this->schoolReport->sign($name);
    }
}

class HighScoreDecorator extends Decorator
{
    public function __construct(SchoolReport $report)
    {
        parent::__construct($report);
    }
    
    public function reportHighScore()
    {
        echo "Report high score\n";
    }
    
    public function report()
    {
        $this->reportHighScore();
        parent::report();
    }
}

class SortDecorator extends Decorator
{
    public function __construct(SchoolReport $report)
    {
        parent::__construct($report);
    }
    
    public function reportSort()
    {
        echo "Report the Sort\n";
    }
    
    public function report()
    {
        parent::report();
        $this->reportSort();
    }
}

$report = new SchoolReport();

$report = new HighScoreDecorator($report);
$report = new SortDecorator($report);

$report->report();

$report->sign("name");

/*
Report high score
This is the score report
Report the Sort
The sign is: name
*/
