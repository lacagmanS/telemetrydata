<?php


namespace Telemetry;

class TelemetryDetailsView
{


    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function createTelemetryDetailsView(object $view, object $response, array $settings, $telemetrymessage): void
    {

        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'Message_Contents.twig',
            [
                'landing_page' => $landing_page,
                'css_path' => $css_path,
                'page_title' => $application_name,
                'page_heading_1' => 'Enjoy metadata ',
                'page_heading_2' => 'Welcome',
                'telemetrymessage' => $telemetrymessage

            ]);
    }

}