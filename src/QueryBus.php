<?php

namespace Vsmoraes\CQRS;

interface QueryBus
{
    /**
     * Discovers the handler and execute the given query returning the result
     *
     * @param Query $query
     *
     * @return mixed
     */
    public function execute(Query $query);
}
