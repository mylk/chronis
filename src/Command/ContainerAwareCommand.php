<?php

namespace Chronis\Command;

use Symfony\Component\Console\Command\Command;

abstract class ContainerAwareCommand extends Command
{
    private $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }
}
