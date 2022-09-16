<?php
namespace NalikCo\NalikNet\App;

use JetBrains\PhpStorm\NoReturn;

class Bootstrap
{
    public function __construct()
    {

    }

    #[NoReturn] public function run(string $uri, string $method): void
    {
        $route = Router::match($uri, $method);
        $this->loadService($route['service']);
    }

    public function loadService(string $serviceClassName): void
    {
        $service = new $serviceClassName;
        $service->load();
    }
}