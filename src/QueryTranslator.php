<?php

namespace Vsmoraes\CQRS;

interface QueryTranslator
{
    /**
     * Retrive the handler responsible for the given query
     *
     * @param Query $query
     *
     * @return QueryHandler
     */
    public function getHandler(Query $query): QueryHandler;
}
