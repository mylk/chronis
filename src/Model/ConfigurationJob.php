<?php

namespace Chronis\Model;

class ConfigurationJob extends Job
{
    private $type = null;

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
