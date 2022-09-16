<?php
namespace NalikCo\NalikNet\App;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    private static array $routes;

    public static function get(string $uri, string $service): void
    {
        self::$routes[] = [
            'uri' => $uri,
            'method' => 'GET',
            'service' => $service
        ];
    }

    public static function post(string $uri, string $service): void
    {
        self::$routes[] = [
            'uri' => $uri,
            'method' => 'POST',
            'service' => $service
        ];
    }

    #[NoReturn] public static function match(string $uri, string $method): array
    {
        foreach(self::$routes as $route)
        {
            // Проверка на соответствие типа запроса
            if($route['method'] != $method) continue;

            // Поиск URI по массиву существующих route
            preg_match('~^'.$route['uri'].'$~', $uri, $matches);

            if(!empty($matches)) return $route;

            // Перенаправление, если есть такой же route как и URI, но без слэша в конце
            preg_match('~^'.$route['uri'].'/'.'$~', $uri, $matches);
            if(!empty($matches)) self::redirect(substr($uri, 0, -1));

            // Перенаправление, если есть такой же route как и URI, но со слэшем в конце
            preg_match('~^'.$route['uri'].'$~', $uri.'/', $matches);
            if(!empty($matches)) self::redirect(sprintf('%s/', $uri));
        }

        self::notFound();
    }

    #[NoReturn] public static function redirect(string $to): void
    {
        http_response_code(301);
        header(sprintf('Location: %s', $to));
        die();
    }

    #[NoReturn] public static function notFound(): void
    {
        http_response_code(404);
        die();
    }
}