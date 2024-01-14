<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Doctrine\DBAL\DriverManager;

$app->post(
    '/SendMessageP',
    function(Request $request, Response $response)
    use ($app)
    {
        $container = $app->getContainer();

        $loginstatus_controller = $container->get('SendMessageController');
        $loginstatus_controller->createHtmlOutput2($container, $request, $response);
        return $response;
    }
);