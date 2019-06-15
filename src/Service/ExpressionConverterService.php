<?php

namespace Chronis\Service;

use Chronis\Model\CronJob;

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

        $cronJob = new CronJob();
        $cronJob->setCommand($job->getCommand())
            ->setDescription($job->getDescription())
            ->setExpression($expression)
            ->setName($job->getName());

        return $cronJob;
    }
}
