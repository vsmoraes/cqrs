<?php

namespace Vsmoraes\CQRS\Query;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Vsmoraes\CQRS\Query;
use Vsmoraes\CQRS\Query\Event\AfterQueryWasExecuted;
use Vsmoraes\CQRS\Query\Event\BeforeQueryIsExecuted;
use Vsmoraes\CQRS\QueryBus as QueryBusInterface;
use Vsmoraes\CQRS\QueryTranslator;

class QueryBus implements QueryBusInterface
{
    /**
     * @var QueryTranslator
     */
    private $queryTranslator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(QueryTranslator $queryTranslator, EventDispatcherInterface $eventDispatcher)
    {
        $this->queryTranslator = $queryTranslator;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Query $query)
    {
        $handler = $this->queryTranslator->getHandler($query);

        $beforeEvent = new BeforeQueryIsExecuted($query);
        $this->eventDispatcher->dispatch($beforeEvent->getEventName(), $beforeEvent);

        $result = $handler->execute($query);

        $afterEvent = new AfterQueryWasExecuted($query);
        $this->eventDispatcher->dispatch($afterEvent->getEventName(), $afterEvent);

        return $result;
    }
}
