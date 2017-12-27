<?php

namespace Vsmoraes\CQRS;

interface CommandHandler
{
    /**
     * Describes how the given command should be executed
     *
     * @param Command $command
     *
     * @return void
     */
    public function execute(Command $command): void;
}
