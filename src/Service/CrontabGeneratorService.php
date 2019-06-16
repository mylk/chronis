<?php

namespace Chronis\Service;

class CrontabGeneratorService
{
    private $configParser;
    private $expressionConverter;

    public function __construct(
        ConfigurationParserService $configParser,
        ExpressionConverterService $expressionConverter
    ) {
        $this->configParser = $configParser;
        $this->expressionConverter = $expressionConverter;
    }

    public function generate(string $configPath): array
    {
        $jobs = $this->configParser->parse($configPath);

        $cronJobs = [];
        foreach ($jobs as $job) {
            $cronJobs[] = $this->expressionConverter->convert($job);
        }

        return $cronJobs;
    }
}
