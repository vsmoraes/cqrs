<?php

namespace Vsmoraes\CQRS\Query\Translator;

use Psr\Container\ContainerInterface;
use Vsmoraes\CQRS\Exception\HandlerNotFound;
use Vsmoraes\CQRS\Query;
use Vsmoraes\CQRS\QueryHandler;
use Vsmoraes\CQRS\QueryTranslator;

class Container implements QueryTranslator
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getHandler(Query $query): QueryHandler
    {
        $queryClassName = get_class($query);
        $handlerServiceName = str_replace('\\Query\\', '\\QueryHandler\\', $queryClassName);

        if (!$this->container->has($handlerServiceName)) {
            throw HandlerNotFound::forQuery($query, $handlerServiceName);
        }

        return $this->container->get($handlerServiceName);
    }
}
