<?php

namespace Telemetry;

class RegisterUserView
{
    public function __construct(){}

    public function __destruct(){}

    public function createRegisterUserView(
        object $view,
        object $response,
        array $settings,
        array $tainted_parameters,
        array $cleaned_parameters,
        array $results,
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
//                'username' => $tainted_parameters['username'],
//                'userage' => $tainted_parameters['userage'],
//                'password' => $tainted_parameters['password'],
//                'email' => $tainted_parameters['email'],
//                'requirements' => $tainted_parameters['requirements'],
                'sanitised_username' => $cleaned_parameters['sanitised_username'],
//                'validated_userage' => $cleaned_parameters['validated_userage'],
//                'cleaned_password' => $cleaned_parameters['password'],
//                'sanitised_email' => $cleaned_parameters['sanitised_email'],
//                'sanitised_requirements' => $cleaned_parameters['sanitised_requirements'],
//                'hashed_password' => $results['hashed_password'],
//                'libsodium_version' => $libsodium_version,
//                'nonce_value_username' => $results['encrypted']['encrypted_username_and_nonce']['nonce'],
//                'encrypted_username' => $results['encrypted']['encrypted_username_and_nonce']['encrypted_string'],
//                'encrypted_userage' => $results['encrypted']['encrypted_userage_and_nonce']['encrypted_string'],
//                'nonce_value_email' => $results['encrypted']['encrypted_username_and_nonce']['nonce'],
//                'encrypted_email' => $results['encrypted']['encrypted_email_and_nonce']['encrypted_string'],
//                'nonce_value_dietary_requirements' => $results['encrypted']['encrypted_username_and_nonce']['nonce'],
//                'encrypted_requirements' => $results['encrypted']['encrypted_dietary_requirements_and_nonce']['encrypted_string'],
                'encoded_username' => $results['encoded']['encoded_username'],
                'encoded_userage' => $results['encoded']['encoded_userage'],
//                'encoded_email' => $results['encoded']['encoded_email'],
//                'encoded_requirements' => $results['encoded']['encoded_requirements'],
//                'decrypted_username' => $results['decrypted']['username'],
//                'decrypted_email' => $results['decrypted']['email'],
//                'decrypted_dietary_requirements' => $results['decrypted']['dietary_requirements'],
//                'storage_result' => $storage_result,
                'landing_page2' => 'TelemetryAttempt',
            ]);
    }
}