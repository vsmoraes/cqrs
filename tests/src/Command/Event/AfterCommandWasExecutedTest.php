<?php

namespace Vsmoraes\CQRS\Tests\Command\Event;

use PHPUnit\Framework\TestCase;
use Vsmoraes\CQRS\Command\Event\AfterCommandWasExecuted;
use Vsmoraes\CQRS\Tests\Fixtures\Command\CommandStub;

class AfterCommandWasExecutedTest extends TestCase
{
    public function testShouldValidateEventGetters()
    {
        $command = new CommandStub();
        $event = new AfterCommandWasExecuted($command);

        $this->assertSame($command, $event->getCommand());
        $this->assertEquals('vsmoraes.cqrs.command.after_execution.command_stub', $event->getEventName());
    }
}
