<?php

namespace Vsmoraes\CQRS\Tests\Query\Translator;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Vsmoraes\CQRS\Exception\HandlerNotFound;
use Vsmoraes\CQRS\Query\Translator\Container;
use Vsmoraes\CQRS\Tests\Fixtures\Query\QueryStub;
use Vsmoraes\CQRS\Tests\Fixtures\QueryHandler\QueryStub as QueryStubHandler;

class ContainerTest extends TestCase
{
    public function testShouldRetrieveHandlerForQuery()
    {
        $query = new QueryStub();
        $expectedHandler = new QueryStubHandler();

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

        $this->assertSame($expectedHandler, $translator->getHandler($query));
    }

    public function testShouldThrowExceptionWhenHandlerWasNotFound()
    {
        $this->expectException(HandlerNotFound::class);

        $query = new QueryStub();

        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('has')
            ->willReturn(false);

        $translator = new Container($containerMock);

        $translator->getHandler($query);
    }
}
