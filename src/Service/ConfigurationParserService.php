<?php

namespace Chronis\Service;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

use Chronis\Model\Configuration\Job;

class ConfigurationParserService
{
    public function parse()
    {
        try {
            $data = Yaml::parseFile(__DIR__ . "/../../config/chronis.example.yaml");
        } catch (ParseException $exception) {
            printf("Unable to parse the YAML string: %s", $exception->getMessage());
        }

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
