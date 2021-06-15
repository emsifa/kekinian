<?php

namespace App\Modules\Welcome\Controllers;

use Emsifa\Kekinian\Controller;
use Emsifa\Kekinian\Route\Delete;
use Emsifa\Kekinian\Route\Get;
use Emsifa\Kekinian\Route\Patch;
use Emsifa\Kekinian\Route\Post;
use Emsifa\Kekinian\Route\Put;

#[Controller("/welcome")]
class WelcomeController
{
    #[Get]
    public function welcome()
    {
        echo "Welcome with GET method";
    }

    #[Post]
    public function postSomething()
    {
        echo "Welcome with POST method";
    }

    #[Put]
    public function putSomething()
    {
        echo "Welcome with PUT method";
    }

    #[Patch]
    public function patchSomething()
    {
        echo "Welcome with PATCH method";
    }

    #[Delete]
    public function deleteSomething()
    {
        echo "Welcome with DELETE method";
    }
}
