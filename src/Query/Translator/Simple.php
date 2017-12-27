<?php

namespace Vsmoraes\CQRS\Query\Translator;

use Vsmoraes\CQRS\Exception\HandlerNotFound;
use Vsmoraes\CQRS\Query;
use Vsmoraes\CQRS\QueryHandler;
use Vsmoraes\CQRS\QueryTranslator;

class Simple implements QueryTranslator
{
    /**
     * {@inheritdoc}
     */
    public function getHandler(Query $query): QueryHandler
    {
        $queryName = get_class($query);
        $handlerName = str_replace('\\Query\\', '\\QueryHandler\\', $queryName);

        if (!class_exists($handlerName)) {
            throw HandlerNotFound::forQuery($query, $handlerName);
        }

        return new $handlerName;
    }
}
