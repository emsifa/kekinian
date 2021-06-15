<?php

namespace Emsifa\Kekinian;

use Attribute;
use Emsifa\Kekinian\Interfaces\RouteModifier;
use Emsifa\Kekinian\Route\Route;

#[Attribute(Attribute::TARGET_CLASS)]
class Controller implements RouteModifier
{
    protected string $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function modifyRoute(Route $route): Route
    {
        $path = $this->prefix . $route->getPath();

        $newRoute = clone $route;
        $newRoute->setPath($path);

        return $newRoute;
    }
}
