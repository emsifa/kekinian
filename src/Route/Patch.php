<?php

namespace Emsifa\Kekinian\Route;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Patch extends Route
{
    public function __construct(string $path = "")
    {
        parent::__construct("PATCH", $path);
    }
}
