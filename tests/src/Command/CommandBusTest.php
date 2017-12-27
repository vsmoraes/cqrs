<?php

namespace Vsmoraes\CQRS\Tests\Command;

use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Vsmoraes\CQRS\Command\CommandBus;
use Vsmoraes\CQRS\Command\Event\AfterCommandWasExecuted;
use Vsmoraes\CQRS\Command\Event\BeforeCommandIsExecuted;
use Vsmoraes\CQRS\CommandTranslator;
use Vsmoraes\CQRS\Tests\Fixtures\Command\CommandStub;
use Vsmoraes\CQRS\Tests\Fixtures\CommandHandler\CommandStub as CommandHandlerStub;

class CommandBusTest extends TestCase
{
    public function testShouldHandleCommand()
    {
        $command = new CommandStub();
        $expectedBeforeEvent = new BeforeCommandIsExecuted($command);
        $expectedAfterEvent = new AfterCommandWasExecuted($command);

        $handlerSpy = $this->createMock(CommandHandlerStub::class);
        $handlerSpy->expects($this->once())
            ->method('execute')
            ->with($command);

        $translatorMock = $this->createMock(CommandTranslator::class);
        $translatorMock->expects($this->once())
            ->method('getHandler')
            ->willReturn($handlerSpy);

        $eventDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcherMock->expects($this->at(0))
            ->method('dispatch')
            ->with($expectedBeforeEvent->getEventName(), $expectedBeforeEvent);
        $eventDispatcherMock->expects($this->at(1))
            ->method('dispatch')
            ->with($expectedAfterEvent->getEventName(), $expectedAfterEvent);

        $commandBus = new CommandBus($translatorMock, $eventDispatcherMock);
        $commandBus->execute($command);
    }
}
