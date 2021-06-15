<?php

use App\Modules\Welcome\WelcomeModule;
use Emsifa\Kekinian\App;

require __DIR__ . "/../vendor/autoload.php";

$app = new App();

$app->registerModule(new WelcomeModule());

$app->run();
