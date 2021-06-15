<?php

namespace App\Modules\Welcome;

use App\Modules\Welcome\Controllers\WelcomeController;
use Emsifa\Kekinian\Module;

class WelcomeModule extends Module
{
    public function getControllers(): array
    {
        return [
            WelcomeController::class,
        ];
    }
}
