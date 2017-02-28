<?php
defined('THEME_BOOTSTRAPPED') or exit();

$template_title = $template_title ?? $template_subject;
$template_head = $template_head ?? function(){};

$base_template = function()
use ($template_title, $template_subject, $template_head, $template_body) {
    //global $theme_assets;
    //global $site_name;
    $theme_assets = 'http://temp.local/';
    $site_name = 'GEL';

    //$business = get_option('theme_contact_business') ?? $site_name;
    //$company_number = get_option('theme_contact_company_number') ?? '';
    //$address = preg_replace('/\s*\r?\n/', ', ', get_option('theme_contact_address'));
    //$email = get_option('theme_contact_email') ?? '';
    //$tel = get_option('theme_contact_tel');

    $business = 'Glos Enterprise Limited' ?? $site_name;
    $address = preg_replace('/\s*\r?\n/', ', ', 'Unit 3, Twigworth Court Business Centre, Tewkesbury Road Twigworth, Gloucester, GL2 9PG');
    $email = 'info@glosenterprise.com' ?? '';
    $tel = '01345 763 837';
    $links = [
        'Homepage' => 'http://temp.local/',
        //'Account' => 'http://temp.local/account/',
    ];

    $re_whitelist_tel = '/[0-9+]+/';
    preg_match_all($re_whitelist_tel, $tel, $parts);
    $tel_whitelisted = implode('', $parts[0]);
    $links_markup = '';
    foreach ($links as $link_text => &$link_url) {
        if (strlen($links_markup)) $links_markup .= " &mdash; ";
        $links_markup .= "<a href=\"{$link_url}\">{$link_text}</a>";
    }
    if (strlen($links_markup)) $links_markup = "<p>{$links_markup}</p>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $template_title ?? $template_subject ?? '' ?></title>
        <style><?= $mail_stylesheet_content ?? '' ?></style>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <?php $template_head() ?>
    </head>
    <body class="tertia">
        <div class="header">
            <div class="tertia__wrapper">
            <img class="header__logo" src="<?= $theme_assets ?>/images/logo-colour-100h.png" alt="<?= $business ?>">
            </div>
        </div>
        <div class="tertia__wrapper main">
            <?php $template_body() ?>
            <div class="tertia__clearfix"></div>
        </div>
        <div class="footer">
            <div class="tertia__wrapper">
                <p><span class="footer__full-color footer__from"><?= $business ?></span><br>
                    <?= isset($company_number) ? "Company No. {$company_number}<br>" : '' ?>
                <p>Email: <a href="mailto:<?= $email ?>"><?= $email ?></a><br>
                    Telephone: <a href="tel:<?= $tel_whitelisted ?>"><?= $tel ?></a></p>
                    <p><?= $address ?></p>
                <?= $links_markup ?>
            </div>
        </div>
    </body>
</html>
<?php };
