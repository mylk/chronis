<?php

namespace Chronis\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class ContainerAwareCommand extends Command
{
    private $container = null;

    public function setContainer(ContainerBuilder $container): ContainerAwareCommand
    {
        $this->container = $container;

        return $this;
    }

    public function getContainer(): ContainerBuilder
    {
        return $this->container;
    }
}
