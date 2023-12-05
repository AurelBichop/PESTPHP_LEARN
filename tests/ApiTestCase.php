<?php

namespace Tests;


use App\Http\Kernel;
use App\Http\Request;
use App\Http\Response;
use League\Container\Container;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class ApiTestCase extends BaseTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        $this->container = include dirname(__DIR__). '/config/services.php';
    }

    public function json(
        string $method = 'GET',
        string $uri = '/',
        array  $data = [],
        array  $headers = []
    ): Response
    {
        // Json encode the data
        $content = json_encode($data);

        // Merge server variables with $headers
        $server = array_merge([
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json'
        ],$headers);

        // Create a $request using a static named constructor
        $request = Request::create(
            method: $method,
            uri: $uri,
            server: $server,
            content: $content
        );

//        $router = new Router();
//        $router->setRoutes();

        // Create / resolve the Kernel
        $kernel = $this->container->get(Kernel::class);

        //$kernel = new Kernel($router);

        // Obtain a $response object : $response = $kernel->handle($request)
        $response = $kernel->handle($request);

        // Return the $response
        return $response;
    }
}
