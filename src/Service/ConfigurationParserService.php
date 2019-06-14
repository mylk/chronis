<?php

namespace Chronis\Service;

use Symfony\Component\Yaml\Yaml;
use Chronis\Model\Configuration\Job;

class ConfigurationParserService
{
    public function parse($configPath)
    {
        $data = Yaml::parseFile($configPath);

        $jobs = [];
        foreach ($data["jobs"] as $jobName => $jobDetails) {
            $jobObject = new Job();
            $jobObject->setName($jobName)
                ->setDescription($jobDetails["description"])
                ->setExpression($jobDetails["expression"])
                ->setCommand($jobDetails["command"]);
            $jobs[] = $jobObject;
        }

        return $jobs;
    }
}
