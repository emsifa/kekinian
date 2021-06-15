<?php

namespace Emsifa\Kekinian\Route;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Delete extends Route
{
    public function __construct(string $path = "")
    {
        parent::__construct("DELETE", $path);
    }
}
