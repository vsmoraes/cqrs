<?php

namespace Vsmoraes\CQRS\Tests\Command\Event;

use PHPUnit\Framework\TestCase;
use Vsmoraes\CQRS\Command\Event\BeforeCommandIsExecuted;
use Vsmoraes\CQRS\Tests\Fixtures\Command\CommandStub;

class BeforeCommandIsExecutedTest extends TestCase
{
    public function testShouldValidateEventGetters()
    {
        $command = new CommandStub();
        $event = new BeforeCommandIsExecuted($command);

        $this->assertSame($event->getCommand(), $command);
        $this->assertEquals('vsmoraes.cqrs.command.before_execution.command_stub', $event->getEventName());
    }
}
