<?php

namespace Vsmoraes\CQRS\Common;

trait StringTransforms
{
    /**
     * @param string $string
     *
     * @return string
     */
    protected function toSnakeCase(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
