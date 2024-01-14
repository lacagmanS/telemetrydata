<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Doctrine\DBAL\DriverManager;

$app->get(
    '/SendMessage',
    function(Request $request, Response $response)
    use ($app) {
        $container = $app->getContainer();
        var_dump("2");

        $sendmessagecontroller = $container->get('SendMessageController');
        $sendmessagecontroller->createHtmlOutput($container, $request, $response);
        return $response;

    }
);
