<?php

namespace Vsmoraes\CQRS\Tests\Command\Translator;

use PHPUnit\Framework\TestCase;
use Vsmoraes\CQRS\Command\Translator\Simple;
use Vsmoraes\CQRS\Exception\HandlerNotFound;
use Vsmoraes\CQRS\Tests\Fixtures\Command\CommandStub;
use Vsmoraes\CQRS\Tests\Fixtures\CommandHandler\CommandStub as CommandHandlerStub;
use Vsmoraes\CQRS\Tests\Fixtures\Command\NoHandlerCommand;

class SimpleTest extends TestCase
{
    public function testShouldRetrieveHandlerForCommand()
    {
        $expectedHandler = new CommandHandlerStub();
        $command = new CommandStub();
        $translator = new Simple();

        $this->assertEquals($expectedHandler, $translator->getHandler($command));
    }

    public function testShouldThrowExceptionWhenHandlerWasNotFound()
    {
        $this->expectException(HandlerNotFound::class);

        $command = new NoHandlerCommand();
        $translator = new Simple();

        $translator->getHandler($command);
    }
}
