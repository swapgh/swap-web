<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Simple HTTP Router
 * 
 * Handles GET/POST routes, middleware, and dispatching to controller actions or closures.
 */
final class Router
{
    /** @var array Stores all routes grouped by HTTP method */
    private array $routes = [];

    /**
     * Register a GET route
     *
     * @param string $path Route path (e.g. '/home')
     * @param callable|array $handler Closure or [ControllerClass, 'method'] array
     * @param array $middleware List of middleware class names
     */
    public function get(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->add('GET', $path, $handler, $middleware);
    }

    /**
     * Register a POST route
     *
     * @param string $path Route path
     * @param callable|array $handler Closure or [ControllerClass, 'method']
     * @param array $middleware Middleware classes to execute
     */
    public function post(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->add('POST', $path, $handler, $middleware);
    }

    /**
     * Internal method to add a route to the routes array
     *
     * @param string $method HTTP method ('GET' or 'POST')
     * @param string $path Route path
     * @param callable|array $handler Handler for the route
     * @param array $middleware Middleware classes
     */
    private function add(string $method, string $path, callable|array $handler, array $middleware): void
    {
        // Normalize path and store route info
        $this->routes[$method][$this->normalize($path)] = [
            'handler' => $handler,
            'middleware' => $middleware,
        ];
    }

    /**
     * Dispatch the incoming request to the appropriate route
     *
     * @param string $method HTTP method
     * @param string $uri Requested URI
     */
    public function dispatch(string $method, string $uri): void
    {
        $path = $this->normalize($uri);

        // Look up the route by method and normalized path
        $route = $this->routes[$method][$path] ?? null;

        // Route not found → 404
        if ($route === null) {
            http_response_code(404);
            (new \App\Http\Controllers\Web\HomeController())->notFound();
            return;
        }

        // Execute any middleware assigned to this route
        foreach ($route['middleware'] as $middlewareClass) {
            (new $middlewareClass())->handle();
        }

        // Call the route handler
        $handler = $route['handler'];

        if (is_array($handler)) {
            // If handler is [ControllerClass, 'method']
            [$class, $action] = $handler;
            (new $class())->{$action}();
            return;
        }

        // If handler is a closure
        $handler();
    }

    /**
     * Normalize a path string
     *
     * Ensures all paths start with a single '/' and removes trailing slashes
     *
     * @param string $path The path to normalize
     * @return string Normalized path
     */
    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        // Convert double slash to single slash for root
        return $path === '//' ? '/' : $path;
    }
}
