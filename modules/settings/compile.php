#!/usr/bin/php
<?php

$dir    = dirname(__FILE__).'/locale/';
$handle = opendir($dir);

while (false !== ($language = readdir($handle))) {
    if ($language == '.' || $language == '..') {
        continue;
    }

    $po = $dir.$language.'/LC_MESSAGES/settings.po';
    $mo = $dir.$language.'/LC_MESSAGES/settings.mo';

    if (file_exists($po)) {
        system("msgfmt {$po} -o $mo");
    }
}
