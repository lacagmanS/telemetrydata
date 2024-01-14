<?php

namespace Telemetry;

class TelemetryAttemptView
{


    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function createTelemetryAttemptView(object $view, object $response, array  $settings, $telemetrymessage): void
    {

        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];
        var_dump($telemetrymessage);
        if (!empty($telemetrymessage) && !in_array(null, $telemetrymessage, true)) {


            $view->render(
                $response,
                'next_page.twig',
                [
                    'landing_page' => $landing_page,
                    'css_path' => $css_path,
                    'page_title' => $application_name,
                    'page_heading_1' => 'Here is your Telemetry Data',
                    'page_heading_2' => 'Welcome',
                    'telemetrymessage' => $telemetrymessage,
                    'telemetryDetails' => 'TelemetryDetails',
                    'SendMessage' => 'SendMessage',


                ]);
        }
        else{
            $view->render(
                $response,
                'next_page.twig',
                [
                    'landing_page' => $landing_page,
                    'css_path' => $css_path,
                    'page_title' => $application_name,
                    'page_heading_1' => 'Here is your Telemetry Data',
                    'page_heading_2' => 'Welcome, no messages right now',
                    'telemetrymessage' => $telemetrymessage,

                    'SendMessage' => 'SendMessage',

                ]);
        }
    }

}