<?php

namespace Emsifa\Kekinian\Interfaces;

use Emsifa\Kekinian\Route\Route;

interface RouteModifier
{
    public function modifyRoute(Route $route): Route;
}
