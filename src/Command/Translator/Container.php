<?php

namespace Vsmoraes\CQRS\Command\Translator;

use Psr\Container\ContainerInterface;
use Vsmoraes\CQRS\Command;
use Vsmoraes\CQRS\CommandHandler;
use Vsmoraes\CQRS\CommandTranslator;
use Vsmoraes\CQRS\Exception\HandlerNotFound;

class Container implements CommandTranslator
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getHandler(Command $command): CommandHandler
    {
        $commandClassName = get_class($command);
        $handlerServiceName = str_replace('\\Command\\', '\\CommandHandler\\', $commandClassName);

        if (!$this->container->has($handlerServiceName)) {
            throw HandlerNotFound::forCommand($command, $handlerServiceName);
        }

        return $this->container->get($handlerServiceName);
    }
}
