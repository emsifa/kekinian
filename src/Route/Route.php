<?php

namespace Emsifa\Kekinian\Route;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    protected string $method;
    protected string $path;

    public function __construct(string $method, string $path)
    {
        $this->method = $method;
        $this->path = $path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return "{$this->method}:{$this->path}";
    }
}
