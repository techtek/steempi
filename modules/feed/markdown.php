<?php

require '../../app/autoload.php';

if (!isset($_POST['content'])) {
    exit;
}

use Michelf\Markdown;

$html = Markdown::defaultTransform($_POST['content']);

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

echo $html;
exit;
