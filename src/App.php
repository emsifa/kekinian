<?php

namespace Emsifa\Kekinian;

use Emsifa\Kekinian\Route\Route;
use Exception;
use ReflectionAttribute;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

class App
{
    /**
     * @var Module[]
     */
    protected array $modules = [];

    public function registerModule(Module $module)
    {
        $this->modules[] = $module;
    }

    /**
     * @return Module[]
     */
    public function getModules()
    {
        return $this->modules;
    }

    public function run()
    {
        $request = Request::createFromGlobals();
        $routes = $this->getRoutes();

        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $matcher = new Routing\Matcher\UrlMatcher($routes, $context);

        try {
            $result = $matcher->match($request->getPathInfo());
            ob_start();

            $this->dispatch($result);

            $response = new Response(ob_get_clean());
        } catch (Routing\Exception\ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (Routing\Exception\MethodNotAllowedException $exception) {
            $response = new Response('Method not allowed', 405);
        } catch (Exception $exception) {
            $response = new Response('An error occurred', 500);
        }

        $response->send();
    }

    public function getRoutes(): Routing\RouteCollection
    {
        $routes = new Routing\RouteCollection();

        $modules = $this->getModules();
        foreach ($modules as $module) {
            $controllers = $module->getControllers();
            foreach ($controllers as $controller) {
                $controllerRoutes = $this->getRoutesFromController($controller);
                foreach ($controllerRoutes as $route) {
                    $routes->add(
                        $route['name'],
                        new Routing\Route(
                            $route['path'],
                            defaults: [
                                '_context' => [
                                    'route' => $route,
                                ]
                            ],
                            methods: [$route['method']]
                        ),
                    );
                }
            }
        }

        return $routes;
    }

    public function getRoutesFromController(string $controller)
    {
        $routes = [];

        $reflection = new ReflectionClass($controller);
        $methods = $reflection->getMethods();
        foreach ($methods as $method) {
            $attributes = $method->getAttributes(Route::class, ReflectionAttribute::IS_INSTANCEOF);
            if (count($attributes) > 0) {
                $attr = $attributes[0]->newInstance();
                $routes[] = [
                    'handler' => [$controller, $method->getName()],
                    'method' => $attr->getMethod(),
                    'path' => $attr->getPath(),
                    'name' => $attr->getName(),
                ];
            }
        }

        return $routes;
    }

    public function dispatch(array $result)
    {
        [$controller, $method] = $result['_context']['route']['handler'];
        $ctrl = new $controller;

        $args = $this->resolveArgs($result);

        call_user_func_array([$ctrl, $method], $args);
    }

    public function resolveArgs(array $result)
    {
        $args = [];

        foreach ($result as $key => $value) {
            if (substr($key, 0, 1) != "_") {
                $args[$key] = $value;
            }
        }

        return $args;
    }
}
