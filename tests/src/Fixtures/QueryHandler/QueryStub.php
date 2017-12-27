<?php

namespace Vsmoraes\CQRS\Tests\Fixtures\QueryHandler;

use Vsmoraes\CQRS\Query;
use Vsmoraes\CQRS\QueryHandler;

class QueryStub implements QueryHandler
{
    /**
     * {@inheritdoc}
     */
    public function execute(Query $query)
    {
        return ['foo' => 'bar'];
    }
}
