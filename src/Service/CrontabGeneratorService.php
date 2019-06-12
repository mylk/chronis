<?php

namespace Chronis\Service;

class CrontabGeneratorService
{
    public function generate($jobs)
    {
        $output = "";
        foreach ($jobs as $job) {
            $output .= $job->getExpression() . " " . $job->getCommand() . "\n";
        }

        return $output;
    }
}
