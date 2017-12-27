<?php

namespace Vsmoraes\CQRS\Query\Event;

use Symfony\Component\EventDispatcher\Event;
use Vsmoraes\CQRS\Common\StringTransforms;
use Vsmoraes\CQRS\Query;

class BeforeQueryIsExecuted extends Event
{
    use StringTransforms;

    private const EVENT_NAME = 'vsmoraes.cqrs.query.before_execution.%s';

    /**
     * @var Query
     */
    private $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        $className = $this->toSnakeCase((new \ReflectionClass($this->query))->getShortName());
        return sprintf(static::EVENT_NAME, $className);
    }
}
