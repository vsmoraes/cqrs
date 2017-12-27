<?php

namespace Vsmoraes\CQRS;

interface CommandTranslator
{
    /**
     * Retrive the handler responsible for the given command
     *
     * @param Command $command
     *
     * @return CommandHandler
     */
    public function getHandler(Command $command): CommandHandler;
}
