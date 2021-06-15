<?php

namespace App\Modules\Welcome\Controllers;

use Emsifa\Kekinian\Route\Delete;
use Emsifa\Kekinian\Route\Get;
use Emsifa\Kekinian\Route\Patch;
use Emsifa\Kekinian\Route\Post;
use Emsifa\Kekinian\Route\Put;

class WelcomeController
{
    #[Get("/welcome")]
    public function welcome()
    {
        echo "Welcome with GET method";
    }

    #[Post("/welcome")]
    public function postSomething()
    {
        echo "Welcome with POST method";
    }

    #[Put("/welcome")]
    public function putSomething()
    {
        echo "Welcome with PUT method";
    }

    #[Patch("/welcome")]
    public function patchSomething()
    {
        echo "Welcome with PATCH method";
    }

    #[Delete("/welcome")]
    public function deleteSomething()
    {
        echo "Welcome with DELETE method";
    }
}
