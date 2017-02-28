<?php
defined('THEME_BOOTSTRAPPED') or exit();

$to_address_list = function(&$person) {
    $name = $person['name'] ?? '';
    $email = $person['email'] ?? '';
    return "{$name} <{$email}>";
};

function send_mail(
    $to,
    $subject = '',
    $body = ''
) {
    if (count($to) < 1) return FALSE;
    if (isset($to['name'])) $to = [ $to ];

    global $site_name;
    global $site_email;

    // ideally noreply address from site config
    $from_email = 'noreply@glosenterprise.com';
    $from = "{$site_name} <{$from_email}>";

    global $to_address_list;
    $addresses = array_map($to_address_list, $to);
    $bcc_field = implode(',', $addresses);

    $headers = "Content-Type: text/html; charset=UTF-8\n"
        . "From: {$from}\n"
        . "Reply-To: {$from}\n"
        . "Bcc: {$bcc_field}\n"
        . "X-Mailer:";

    mail('', $subject, $body, $headers);
}
