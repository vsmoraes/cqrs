<?php

namespace Vsmoraes\CQRS\Command\Event;

use Symfony\Component\EventDispatcher\Event;
use Vsmoraes\CQRS\Command;
use Vsmoraes\CQRS\Common\StringTransforms;

class AfterCommandWasExecuted extends Event
{
    use StringTransforms;

    private const EVENT_NAME = 'vsmoraes.cqrs.command.after_execution.%s';

    /**
     * @var Command
     */
    private $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * @return Command
     */
    public function getCommand(): Command
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        $className = $this->toSnakeCase((new \ReflectionClass($this->command))->getShortName());
        return sprintf(static::EVENT_NAME, $className);
    }
}
