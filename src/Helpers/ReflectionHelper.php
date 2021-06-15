<?php

namespace Emsifa\Kekinian\Helpers;

class ReflectionHelper
{
    /**
     * @param  \ReflectionClass|\ReflectionMethod|\ReflectionFunction|\ReflectionProperty $reflection
     * @param  string|null $name
     * @param  int $flags
     * @return array
     */
    public static function getAttributeInstances(
        $reflection,
        ?string $name = null,
        int $flags = 0
    ): array
    {
        $attributes = $reflection->getAttributes($name, $flags);
        return array_map(fn ($attr) => $attr->newInstance(), $attributes);
    }
}
