<?php

require '../../app/autoload.php';

if (!isset($_POST['content'])) {
    exit;
}

use Michelf\Markdown;

$html = Markdown::defaultTransform($_POST['content']);

// cleanup
$html = preg_replace_callback(
    '#<p><img([^>]*)></p>#i',
    function ($output) {
        $result = $output[0];
        $result = str_replace('<p>', '<figure>', $result);
        $result = str_replace('</p>', '</figure>', $result);

        return $result;
    },
    $html
);

$html = preg_replace_callback(
    '#<center><img([^>]*)></center>#i',
    function ($output) {
        $result = $output[0];
        $result = str_replace('<center>', '<figure>', $result);
        $result = str_replace('</center>', '</figure>', $result);

        return $result;
    },
    $html
);

$html = str_replace('<p><figure>', '', $html);
$html = str_replace('</figure></p>', '', $html);
$html = str_replace('<p></p>', '', $html);
$html = str_replace("\n", '', $html);

// parse empty images
$html = preg_replace_callback(
    '/\>(https:\\/\\/.+(\.png|\.jpeg|\.jpg|\.gif|\.bmp))/Ui',
    function ($output) {
        return '><img src="'.trim($output[0], '>').'" />';
    },
    $html
);

echo $html;
exit;
