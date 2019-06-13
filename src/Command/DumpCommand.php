<?php

namespace Chronis\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DumpCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName("dump")
            ->setDescription("Dumps the crontab file")
            ->setHelp('Reads a configuration file that defines the jobs, converts them to a crontab and dumps it to the console.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $crontabGenerator = $this->getContainer()->get("crontab_generator");
        $jobs = $crontabGenerator->generate();

        foreach ($jobs as $job) {
            $output->writeln($job->getExpression() . " " . $job->getCommand());
        }
    }
}
