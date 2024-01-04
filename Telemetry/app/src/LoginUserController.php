<?php


namespace Telemetry;

class LoginUserController
{

    public function createHtmlOutput(object $container, object $request, object $response): void
    {
        $login_view = $container->get('LoginUserView');
        $view = $container->get('view');
        $settings = $container->get('settings');

        $login_view->createLoginPageView($view, $settings, $response);
    }
}