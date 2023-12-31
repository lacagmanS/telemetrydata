<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Doctrine\DBAL\DriverManager;

$app->get(
    '/TelemetryDetails',
    function(Request $request, Response $response)
    use ($app)
    {
        $container = $app->getContainer();

        $TelemetryDetailsController = $container->get('TelemetryDetailsController');
        $TelemetryDetailsController->createHtmlOutput($container, $request, $response);
        return $response;
    }
);


