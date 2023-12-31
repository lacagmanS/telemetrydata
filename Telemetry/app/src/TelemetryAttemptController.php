<?php

namespace Telemetry;

class TelemetryAttemptController



{

    public function createHtmlOutput(object $container, object $request, object $response): void
    {


        $view = $container->get('view');
        $settings = $container->get('settings');
        $database_connection_settings = $settings['doctrine_settings'];
        $soap_wrapper = $container->get('soapWrapper');
        $sqlQueries = $container->get('sqlQueries');
        $database_Wrapper = $container->get('DatabaseWrapper');
        $TelemetryAttemptView = $container->get('TelemetryAttemptView');
        $TelemetryAttemptModel= $container->get('TelemetryAttemptModel');
        $TelemetryAttemptValidator = $container->get('validator');


        $telemetry_message = $TelemetryAttemptModel->telemetry_message($soap_wrapper);
        $parsedmessages = $TelemetryAttemptModel->parseMessage($telemetry_message);
        Var_dump($parsedmessages);
        $cleanedmessages = $TelemetryAttemptValidator->sanitizeEachValue($parsedmessages);

if($cleanedmessages !=null) {
    foreach ($cleanedmessages as $message) {
        $message_content = $message['message'];
        $processed_message = $TelemetryAttemptModel->processMessageDetails($message_content);


        // Store each processed message in an array
        $processed_messages[] = $processed_message;
    }
    $TelemetryAttemptModel->storeMessageInDatabase($cleanedmessages, $database_connection_settings, $database_Wrapper, $sqlQueries);


}
else{
    $processed_messages[]=null;
}

        $TelemetryAttemptView->createTelemetryAttemptView($view, $response, $settings, $processed_messages);
    }






}