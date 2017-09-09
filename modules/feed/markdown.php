<?php

require '../../app/autoload.php';

if (!isset($_POST['content'])) {
    exit;
}

use Michelf\Markdown;

echo Markdown::defaultTransform($_POST['content']);
exit;
