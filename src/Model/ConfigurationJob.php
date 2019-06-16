<?php

namespace Chronis\Model;

class ConfigurationJob extends Job
{
    private $type = null;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): ConfigurationJob
    {
        $this->type = $type;

        return $this;
    }
}
