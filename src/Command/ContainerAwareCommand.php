<?php

namespace Chronis\Command;

use Symfony\Component\Console\Command\Command;

abstract class ContainerAwareCommand extends Command
{
    private $container = null;

    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    public function getContainer()
    {
        return $this->container;
    }
}
