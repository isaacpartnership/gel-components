<?php
define('THEME_BOOTSTRAPPED', TRUE);
defined('THEME_BOOTSTRAPPED') or exit();

require_once(__DIR__ . "/sender.php");
require_once(__DIR__ . "/lib/emogrifier/Classes/Emogrifier.php");

function interpolate_template($template, &$data) {
    $mail_stylesheet_path = __DIR__ . "/mail.css";
    $mail_stylesheet_content = file_get_contents($mail_stylesheet_path);
    require(__DIR__ . "/templates/{$template}.php");
    require(__DIR__ . "/templates/base.php");

    ob_start();
    $base_template();
    $content = ob_get_contents();
    ob_end_clean();

    $converter = new \Pelago\Emogrifier($content, $mail_stylesheet_content);
    $content_converted = $converter->emogrify();
    return [$template_subject, $content_converted];
}

// EXAMPLE USE

//global $site_name;
$site_name = 'GEL';
$site_email = 'noreply@jelly.com';

$to = [
    [
        'name' => 'Testing Zoho',
        'email' => 'himself@blieque.co.uk',
    ],
];

// NEWSLETTER THANK-YOU
/*
$data = [
    'name' => 'Barry Darren',
];
list($subject, $body) = interpolate_template('newsletter-thank-you', $data);
send_mail($to, $subject, $body);
*/

// REGISTRATION ACTIVATION ("click link to confirm address")
/*
$data = [
    'name' => 'Barry Darren',
    'activation_url' => 'http://temp.local/account/activation/',
];
list($subject, $body) = interpolate_template('registration-activation', $data);
send_mail($to, $subject, $body);
*/

// REGISTRATION CONFIRMATION ("welcome!")
/*
$data = [
    'name' => 'Barry Darren',
    'login_url' => 'http://temp.local/account/login/',
];
list($subject, $body) = interpolate_template('registration-confirmation', $data);
send_mail($to, $subject, $body);
*/

// ORDER COMPLETE
$data = [
    'name' => 'Barry Darren',
    'basket' => [
        [
            'title' => 'Thing 1',
            'price' => 123.45,
        ],
        [
            'title' => 'Thing 2 with a bit of a longer title to push things to the limit',
            'price' => 54,
        ],
    ],
    'view_orders_url' => 'http://temp.local/account/orders/',
];
list($subject, $body) = interpolate_template('order-complete', $data);
send_mail($to, $subject, $body);
