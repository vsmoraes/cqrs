<?php

namespace Vsmoraes\CQRS;

interface QueryHandler
{
    /**
     * Describes how the query should be executed
     *
     * @param Query $query
     *
     * @return mixed
     */
    public function execute(Query $query);
}
