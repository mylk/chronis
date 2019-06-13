<?php

namespace Chronis\Service;

use Chronis\Model\Cron\Job;

class ExpressionConverterService
{
    private $expressionParser = null;


    public function __construct($expressionParser)
    {
        $this->expressionParser = $expressionParser;
    }

    public function convert($job)
    {
        $expression = $this->expressionParser::fromString($job->getExpression());

        $cronJob = new Job();
        $cronJob->setCommand($job->getCommand())
            ->setExpression($expression);

        return $cronJob;
    }
}
