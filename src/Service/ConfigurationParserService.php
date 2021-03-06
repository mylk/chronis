<?php

namespace Chronis\Service;

use Symfony\Component\Yaml\Yaml;
use Chronis\Model\ConfigurationJob;

class ConfigurationParserService
{
    public function parse(string $configPath): array
    {
        $data = (new Yaml)->parseFile($configPath);

        $jobs = [];
        foreach ($data["jobs"] as $jobName => $jobDetails) {
            $jobObject = new ConfigurationJob();
            $jobObject->setName($jobName)
                ->setType($jobDetails["type"])
                ->setDescription($jobDetails["description"])
                ->setExpression($jobDetails["expression"])
                ->setCommand($jobDetails["command"]);
            $jobs[] = $jobObject;
        }

        return $jobs;
    }
}
