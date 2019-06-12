<?php

namespace Chronis\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName("generate")
            ->setDescription("Generates crontab files.")
            ->setHelp('Reads a configuration file that defines the jobs and converts them to a crontab.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configParser = $this->getContainer()->get("config_parser");
        $cronConverter = $this->getContainer()->get("cron_converter");
        $crontabGenerator = $this->getContainer()->get("crontab_generator");

        $jobs = $configParser->parse();

        $cronJobs = [];
        foreach ($jobs as $job) {
            $cronJobs[] = $cronConverter->convert($job);
        }

        $output->writeln($crontabGenerator->generate($cronJobs));
    }
}
