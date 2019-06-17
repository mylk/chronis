<?php

namespace Chronis\Service;

use BenTools\NaturalCronExpression\NaturalCronExpressionParser;
use BenTools\NaturalCronExpression\ParserException;
use Chronis\Exception\ExpressionParseException;
use Chronis\Model\ConfigurationJob;
use Chronis\Model\CronJob;

class CronConverterService
{
    private $expressionParser = null;

    public function __construct(NaturalCronExpressionParser $expressionParser)
    {
        $this->expressionParser = $expressionParser;
    }

    public function convert(ConfigurationJob $job): CronJob
    {
        try {
            $expression = $this->expressionParser::fromString($job->getExpression());
        } catch (ParserException $ex) {
            throw new ExpressionParseException(
                sprintf(
                    "Unable to parse expression \"%s\" of job named \"%s\".",
                    $job->getExpression(),
                    $job->getName()
                )
            );
        }

        $cronJob = new CronJob();
        $cronJob->setCommand($job->getCommand())
            ->setDescription($job->getDescription())
            ->setExpression($expression)
            ->setName($job->getName());

        return $cronJob;
    }
}
