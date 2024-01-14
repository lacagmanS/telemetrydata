<?php

namespace Telemetry;

class RegisterUserView
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function createRegisterUserView(
        object $view,
        object $response,
        array  $settings,
        array  $tainted_parameters,
        array  $cleaned_parameters,
        array  $results,
        string $storage_result
    ): void
    {
        $libsodium_version = SODIUM_LIBRARY_VERSION;
        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'register_user_result.html.twig',
            [
                'landing_page' => $landing_page,
                'css_path' => $css_path,
                'page_title' => $application_name,
                'page_heading_1' => 'New User Registration',
                'page_heading_2' => 'New User Registration',

                'sanitised_username' => $cleaned_parameters['sanitised_username'],

                'cleaned_password' => $cleaned_parameters['password'],
                'sanitised_email' => $cleaned_parameters['sanitised_email'],

                'hashed_password' => $results['hashed_password'],
                'landing_page2' => 'TelemetryAttempt',
            ]);
    }

    public function createRegisterUserViewNullValues(
        object $view,
        object $response,
        array  $settings,
        array  $tainted_parameters,
               $messagetouser
    ): void
    {

        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'register_user_result.html.twig', // Update with your actual Twig template file
            [
                'landing_page' => $landing_page,
                'css_path' => $css_path,
                'page_title' => $application_name,
                'page_heading_1' => 'New User Registration',
                'page_heading_2' => 'New User Registration Failed',
                'messagetouser' => $messagetouser,
            ]
        );
    }
}