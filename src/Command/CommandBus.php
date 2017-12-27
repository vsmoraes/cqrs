<?php

namespace Vsmoraes\CQRS\Command;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Vsmoraes\CQRS\Command;
use Vsmoraes\CQRS\Command\Event\AfterCommandWasExecuted;
use Vsmoraes\CQRS\Command\Event\BeforeCommandIsExecuted;
use Vsmoraes\CQRS\CommandBus as CommandBusInterface;
use Vsmoraes\CQRS\CommandTranslator;

class CommandBus implements CommandBusInterface
{
    /**
     * @var CommandTranslator
     */
    private $commandTranslator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(CommandTranslator $commandTranslator, EventDispatcherInterface $eventDispatcher)
    {
        $this->commandTranslator = $commandTranslator;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Command $command): void
    {
        $handler = $this->commandTranslator->getHandler($command);

        $beforeEvent = new BeforeCommandIsExecuted($command);
        $this->eventDispatcher->dispatch($beforeEvent->getEventName(), $beforeEvent);

        $handler->execute($command);

        $afterEvent = new AfterCommandWasExecuted($command);
        $this->eventDispatcher->dispatch($afterEvent->getEventName(), $afterEvent);
    }
}
