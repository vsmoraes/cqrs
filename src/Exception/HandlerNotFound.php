<?php

namespace Vsmoraes\CQRS\Exception;

use Vsmoraes\CQRS\Command;
use Vsmoraes\CQRS\Query;

class HandlerNotFound extends \RuntimeException
{
    /**
     * @param Query $query
     * @param string $handlerName
     *
     * @return HandlerNotFound
     */
    public static function forQuery(Query $query, string $handlerName): self
    {
        $queryName = get_class($query);

        return new self('Handler ('.$handlerName.') not found for query ('.$queryName.').');
    }

    /**
     * @param Command $command
     * @param string $handlerName
     *
     * @return HandlerNotFound
     */
    public static function forCommand(Command $command, string $handlerName): self
    {
        $commandName = get_class($command);

        return new self('Handler ('.$handlerName.') not found for command ('.$commandName.').');
    }
}
