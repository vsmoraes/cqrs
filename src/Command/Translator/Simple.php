<?php

namespace Vsmoraes\CQRS\Command\Translator;

use Vsmoraes\CQRS\Command;
use Vsmoraes\CQRS\CommandHandler;
use Vsmoraes\CQRS\CommandTranslator;
use Vsmoraes\CQRS\Exception\HandlerNotFound;

class Simple implements CommandTranslator
{
    /**
     * {@inheritdoc}
     */
    public function getHandler(Command $command): CommandHandler
    {
        $commandName = get_class($command);
        $handlerName = str_replace('\\Command\\', '\\CommandHandler\\', $commandName);

        if (!class_exists($handlerName)) {
            throw HandlerNotFound::forCommand($command, $handlerName);
        }

        return new $handlerName;
    }
}
