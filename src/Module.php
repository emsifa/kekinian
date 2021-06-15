<?php

namespace Emsifa\Kekinian;

abstract class Module
{
    /**
     * @return string[]
     */
    abstract public function getControllers(): array;
}
