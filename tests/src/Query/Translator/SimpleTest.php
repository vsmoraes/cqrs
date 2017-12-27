<?php

namespace Vsmoraes\CQRS\Tests\Query\Translator;

use PHPUnit\Framework\TestCase;
use Vsmoraes\CQRS\Exception\HandlerNotFound;
use Vsmoraes\CQRS\Query\Translator\Simple;
use Vsmoraes\CQRS\Tests\Fixtures\Query\NoHandlerQuery;
use Vsmoraes\CQRS\Tests\Fixtures\Query\QueryStub;
use Vsmoraes\CQRS\Tests\Fixtures\QueryHandler\QueryStub as QueryStubHandler;

class SimpleTest extends TestCase
{
    public function testShouldRetrieveHandlerForQuery()
    {
        $expectedHandler = new QueryStubHandler();
        $query = new QueryStub();
        $translator = new Simple();

        $this->assertEquals($expectedHandler, $translator->getHandler($query));
    }

    public function testShouldThrowExceptionWhenHandlerWasNotFound()
    {
        $this->expectException(HandlerNotFound::class);

        $query = new NoHandlerQuery();
        $translator = new Simple();

        $translator->getHandler($query);
    }
}
