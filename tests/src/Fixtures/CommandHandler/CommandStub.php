<?php

namespace Vsmoraes\CQRS\Tests\Fixtures\CommandHandler;

use Vsmoraes\CQRS\Command;
use Vsmoraes\CQRS\CommandHandler;

class CommandStub implements CommandHandler
{
    /**
     * {@inheritdoc}
     */
    public function execute(Command $command): void
    {

    }
}
