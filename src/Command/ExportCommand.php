<?php

namespace Chronis\Command;

use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName("export")
            ->setDescription("Exports the crontab file")
            ->setHelp("Reads a configuration file that defines the jobs, converts them to a crontab and exports it to a file.")
            ->addOption("config", "c", InputOption::VALUE_REQUIRED, "The input configuration file.", null)
            ->addOption("output", "o", InputOption::VALUE_OPTIONAL, "The output file.", "crontab");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configPath = $input->getOption("config");
        $outputPath = $input->getOption("output");
        if (!$configPath) {
            throw new InvalidOptionException("Option --config is missing.");
        }

        $crontabGenerator = $this->getContainer()->get("crontab_generator");

        $jobs = $crontabGenerator->generate($configPath);
        $data = "";
        foreach ($jobs as $job) {
            $data .= $job->getExpression() . " " . $job->getCommand() . "\n";
        }

        file_put_contents($outputPath, $data);
    }
}
