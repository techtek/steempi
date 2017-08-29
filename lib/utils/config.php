<?php

/**
 * Helper Functions for config saving
 */

/**
 * Saves data to the configuration
 */
function saveConfig($data)
{
    require_once 'language.php';

    $dir  = dirname(dirname(dirname(__FILE__)));
    $file = $dir.'/conf/config.php';

    $currentConfig = require $dir.'/conf/config.php';

    if (!isset($currentConfig['steemitUsername'])) {
        $currentConfig['steemitUsername'] = '';
    }

    // steemit user
    $username = $currentConfig['steemitUsername'];

    if (isset($data['steemitUsername'])) {
        $steemitUsername = str_replace('@', '', $data['steemitUsername']);
        $steemitUsername = preg_replace('/[^a-zA-Z0-9\-]/i', '', $steemitUsername);

        if (!empty($steemitUsername)) {
            $username = $steemitUsername;
        }
    }

    // steempi language
    $language = checkLocaleCode($data['steempiLanguage']);


    // save config
    $template = "<?php
return array(
    'steemitUsername' => '{$username}',
    'steempiLanguage' => '{$language}'
);";


    file_put_contents($file, $template);

    return array(
        'steemitUsername' => $username,
        'steempiLanguage' => $language
    );
}