<?php

namespace Vsmoraes\CQRS;

interface CommandBus
{
    /**
     * Executes the given command
     *
     * @param Command $command
     *
     * @return void
     */
    public function execute(Command $command): void;
}
