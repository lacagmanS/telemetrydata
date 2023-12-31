<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Doctrine\DBAL\DriverManager;

$app->get(
    '/TelemetryAttempt',
    function(Request $request, Response $response)
    use ($app)
    {
        $container = $app->getContainer();


        $TelemetryAttemptController = $container->get('TelemetryAttemptController');
        $TelemetryAttemptController->createHtmlOutput($container, $request, $response);
        return $response;
    }
);


