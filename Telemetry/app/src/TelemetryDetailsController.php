<?php


namespace Telemetry;

class TelemetryDetailsController


{

    public function createHtmlOutput(object $container, object $request, object $response): void
    {
        $view = $container->get('view');
        $settings = $container->get('settings');
        $database_connection_settings = $settings['doctrine_settings'];
        $soap_wrapper = $container->get('soapWrapper');
        $sqlQueries = $container->get('sqlQueries');
        $database_Wrapper = $container->get('DatabaseWrapper');
        $TelemetryDetailsView = $container->get('TelemetryDetailsView');
        $TelemetryAttemptModel= $container->get('TelemetryAttemptModel');
        $TelemetryAttemptValidator = $container->get('validator');
        $message =$TelemetryAttemptModel->getMostRecentMessageFromDatabase($database_Wrapper,$sqlQueries,$database_connection_settings);


        $TelemetryDetailsView->createTelemetryDetailsView($view, $response, $settings, $message);


    }


}