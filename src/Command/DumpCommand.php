<?php

namespace Chronis\Command;

use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DumpCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName("dump")
            ->setDescription("Dumps the crontab file")
            ->setHelp("Reads a configuration file that defines the jobs, converts them to a crontab and dumps it to the console.")
            ->addOption("config", "c", InputOption::VALUE_REQUIRED, "The configuration file input.", null);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configPath = $input->getOption("config");
        if (!$configPath) {
            throw new InvalidOptionException("Option --config is missing.");
        }

        $crontabGenerator = $this->getContainer()->get("crontab_generator");

        $jobs = $crontabGenerator->generate($configPath);
        foreach ($jobs as $job) {
            $output->writeln($job->getExpression() . " " . $job->getCommand());
        }
    }
}
