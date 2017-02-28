<?php
define('THEME_BOOTSTRAPPED', TRUE); // move to functions.php in WordPress
defined('THEME_BOOTSTRAPPED') or exit();

/**
 * Mail Bootstrapping
 *
 * Attach mailing code to actions (in a WordPress environment) or to other
 * events in your CMS.
 */

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
// used for mail `from' field, and potentially in templates
$site_name = 'GEL';
// used for mail `from' field (probably not the main contact address)
$site_email = 'noreply@jelly.com';
// path to directory storing static assets (logo, icons, etc.)
$theme_assets = 'http://temp.local/';

// name-email pair OR array of name-email pairs
$to = [
    'name' => 'Testing Zoho',
    'email' => 'testing@isaacpartnership.co.uk',
];

// ORDER COMPLETE
// data object to be passed to the template
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
/**
 * Interpolate the template with the data and pass it to the mailer function.
 * The template name given is used to find the template script
 * "templates/<name>.php".
 */
list($subject, $body) = interpolate_template('order-complete', $data);
send_mail($to, $subject, $body);
