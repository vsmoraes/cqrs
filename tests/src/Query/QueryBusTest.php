<?php

namespace Vsmoraes\CQRS\Tests\Query;

use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Vsmoraes\CQRS\Query\Event\AfterQueryWasExecuted;
use Vsmoraes\CQRS\Query\Event\BeforeQueryIsExecuted;
use Vsmoraes\CQRS\Query\QueryBus;
use Vsmoraes\CQRS\QueryTranslator;
use Vsmoraes\CQRS\Tests\Fixtures\Query\QueryStub;
use Vsmoraes\CQRS\Tests\Fixtures\QueryHandler\QueryStub as QueryStubHandler;

class QueryBusTest extends TestCase
{
    public function testShouldHandleQuery()
    {
        $query = new QueryStub();
        $expectedBeforeEvent = new BeforeQueryIsExecuted($query);
        $expectedAfterEvent = new AfterQueryWasExecuted($query);
        $expectedResult = ['foo' => 'bar'];

        $handlerSpy = $this->createMock(QueryStubHandler::class);
        $handlerSpy->expects($this->once())
            ->method('execute')
            ->with($query)
            ->willReturn($expectedResult);

        $translatorMock = $this->createMock(QueryTranslator::class);
        $translatorMock->expects($this->once())
            ->method('getHandler')
            ->with($query)
            ->willReturn($handlerSpy);

        $eventDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcherMock->expects($this->at(0))
            ->method('dispatch')
            ->with($expectedBeforeEvent->getEventName(), $expectedBeforeEvent);
        $eventDispatcherMock->expects($this->at(1))
            ->method('dispatch')
            ->with($expectedAfterEvent->getEventName(), $expectedAfterEvent);

        $queryBus = new QueryBus($translatorMock, $eventDispatcherMock);
        $result = $queryBus->execute($query);

        $this->assertEquals($expectedResult, $result);
    }
}
