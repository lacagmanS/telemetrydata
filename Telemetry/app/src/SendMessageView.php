<?php

namespace Telemetry;

class SendMessageView
{
    public function __construct(){}

    public function __destruct(){}

    public function createSendMessagePageView($view, array $settings, $response): void
    {
        $landing_page = $settings['landing_page'];
        $application_name = $settings['application_name'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'send_message.html.twig',
            [
                'css_path' => $css_path,
                'landing_page' => $landing_page,
                'action' => 'SendMessageP',
                'method' => 'post',
                'initial_input_box_value' => null,
                'page_title' => $application_name,
                'page_heading_1' => $application_name,
                'page_heading_2' => 'Send Message'
            ]);
    }
    public function createSendMessagePageView2($view,  $settings, $response, $message, $messagesent): void
    {

        $landing_page = $settings['landing_page'];
        $application_name = $settings['application_name'];
        $css_path = $settings['css_path'];


            if ($messagesent) {
                $view->render(
                    $response,
                    'send_message.html.twig',
                    [
                        'css_path' => $css_path,
                        'landing_page' => $landing_page,
                        'method' => 'get',
                        'page_title' => $application_name,
                        'page_heading_1' => $application_name,
                        'page_heading_2' => 'message was sent',
                        'sent_message' => $message
                    ]);
            } else {
                $view->render(
                    $response,
                    'send_message.html.twig',
                    [
                        'css_path' => $css_path,
                        'landing_page' => $landing_page,
                        'method' => 'get',
                        'page_title' => $application_name,
                        'page_heading_1' => $application_name,
                        'page_heading_2' => 'Message wasnt sent',

                    ]);
            }
        }

}
