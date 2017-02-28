<?php
defined('THEME_BOOTSTRAPPED') or exit();

/**
 * Mail Sender
 *
 * Wrapper around the PHP's `mail()'. This adds headers and formats `to' and
 * `from' fields nicely. Separating this out makes it easier to replace the
 * `send_mail' function with one that connects via API to the likes of SendGrid
 * or Mailgun instead of using the host's MTA.
 */

$to_address_list = function(&$person) {
    $name = $person['name'] ?? '';
    $email = $person['email'] ?? '';
    return "{$name} <{$email}>";
};

function send_mail($to, $subject = '', $body = '') {
    // require at least one `to' email
    if (count($to) < 1) return FALSE;
    if (isset($to['name'])) $to = [ $to ];

    global $site_name;
    global $site_email;

    $from = "{$site_name} <{$site_email}>";

    // convert recipient name-email pairs array to to/cc/bcc string
    global $to_address_list;
    $addresses = array_map($to_address_list, $to);
    $bcc_field = implode(',', $addresses);

    // use bcc for all recipients to avoid the chance of leaking addresses
    $headers = "Content-Type: text/html; charset=UTF-8\n"
        . "From: {$from}\n"
        . "Reply-To: {$from}\n"
        . "Bcc: {$bcc_field}\n"
        . "X-Mailer:";

    /**
     * PHP adds its own `X-PHP-Originating-Script' header to the email,
     * undesirably. `ini_set("add_x_header", "0");' should disable it, but
     * appears not to. Using an API mailing system might be advisable.
     */
    mail('', $subject, $body, $headers);
}
