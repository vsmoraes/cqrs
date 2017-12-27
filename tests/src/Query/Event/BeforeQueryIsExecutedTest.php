<?php

namespace Vsmoraes\CQRS\Tests\Query\Event;

use PHPUnit\Framework\TestCase;
use Vsmoraes\CQRS\Query\Event\BeforeQueryIsExecuted;
use Vsmoraes\CQRS\Tests\Fixtures\Query\QueryStub;

class BeforeQueryIsExecutedTest extends TestCase
{
    public function testShouldValidateEventGetters()
    {
        $query = new QueryStub();
        $event = new BeforeQueryIsExecuted($query);

        $this->assertSame($query, $event->getQuery());
        $this->assertEquals('vsmoraes.cqrs.query.before_execution.query_stub', $event->getEventName());
    }
}
