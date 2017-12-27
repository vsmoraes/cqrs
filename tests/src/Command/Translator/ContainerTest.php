<?php

namespace Vsmoraes\CQRS\Tests\Command\Translator;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Vsmoraes\CQRS\Command\Translator\Container;
use Vsmoraes\CQRS\Exception\HandlerNotFound;
use Vsmoraes\CQRS\Tests\Fixtures\Command\CommandStub;
use Vsmoraes\CQRS\Tests\Fixtures\CommandHandler\CommandStub as CommandStubHandler;

class ContainerTest extends TestCase
{
    public function testShouldRetrieveHandlerForCommand()
    {
        $command = new CommandStub();
        $expectedHandler = new CommandStubHandler();

        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('has')
            ->with(get_class($expectedHandler))
            ->willReturn(true);
        $containerMock->expects($this->once())
            ->method('get')
            ->with(get_class($expectedHandler))
            ->willReturn($expectedHandler);

        $translator = new Container($containerMock);

        $this->assertSame($expectedHandler, $translator->getHandler($command));
    }

    public function testShouldThrowExceptionWhenHandlerWasNotFound()
    {
        $this->expectException(HandlerNotFound::class);

        $command = new CommandStub();

        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('has')
            ->willReturn(false);

        $translator = new Container($containerMock);
        $translator->getHandler($command);
    }
}
