<?php

namespace Chronis\Service;

class CrontabGeneratorService
{
    private $configParser;
    private $cronConverter;

    public function __construct(
        ConfigurationParserService $configParser,
        CronConverterService $cronConverter
    ) {
        $this->configParser = $configParser;
        $this->cronConverter = $cronConverter;
    }

    public function generate(string $configPath): array
    {
        $jobs = $this->configParser->parse($configPath);

        $cronJobs = [];
        foreach ($jobs as $job) {
            $cronJobs[] = $this->cronConverter->convert($job);
        }

        return $cronJobs;
    }
}
