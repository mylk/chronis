<?php

namespace Chronis\Model;

abstract class Job
{
    private $command = null;
    private $description = null;
    private $expression = null;
    private $name = null;

    public function getCommand(): ?string
    {
        return $this->command;
    }

    public function setCommand(string $command): Job
    {
        $this->command = $command;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): Job
    {
        $this->description = $description;

        return $this;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(string $expression): Job
    {
        $this->expression = $expression;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): Job
    {
        $this->name = $name;

        return $this;
    }
}
