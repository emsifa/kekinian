<?php

namespace Emsifa\Kekinian\Route;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Get extends Route
{
    public function __construct(string $path = "")
    {
        parent::__construct("GET", $path);
    }
}
