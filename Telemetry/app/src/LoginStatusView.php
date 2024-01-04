<?php

namespace Telemetry;

class LoginStatusView
{
    public function __construct(){}

    public function __destruct(){}

    public function CreateLoginStatusView(
        object $view,
        object $response,
        array $settings,
        string $storage_result,
        $loginsucess

    ): void
    {
        $libsodium_version = SODIUM_LIBRARY_VERSION;
        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];
        if ($loginsucess) {

            $view->render(
                $response,
                'login_user_result.html.twig',
                [
                    'landing_page' => $landing_page,
                    'css_path' => $css_path,
                    'page_title' => $application_name,
                    'page_heading_1' => 'Login ',
                    'page_heading_2' => $storage_result ,


                    'landing_page2' => 'TelemetryAttempt',
                ]);
        }
        else {
            $view->render(
                $response,
                'login_user_result.html.twig',
                [
                    'landing_page' => $landing_page,
                    'css_path' => $css_path,
                    'page_title' => $application_name,
                    'page_heading_1' => 'Login ',
                    'page_heading_2' => $storage_result,
                    'login_page' => 'loginUser'

                ]);
        }
    }



}