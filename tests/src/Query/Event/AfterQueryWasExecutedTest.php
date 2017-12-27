<?php

namespace Vsmoraes\CQRS\Tests\Query\Event;

use PHPUnit\Framework\TestCase;
use Vsmoraes\CQRS\Query\Event\AfterQueryWasExecuted;
use Vsmoraes\CQRS\Tests\Fixtures\Query\QueryStub;

class AfterQueryWasExecutedTest extends TestCase
{
    public function testShouldValidateEventGetters()
    {
        $query = new QueryStub();
        $event = new AfterQueryWasExecuted($query);

        $this->assertSame($query, $event->getQuery());
        $this->assertEquals('vsmoraes.cqrs.query.after_execution.query_stub', $event->getEventName());
    }
}
