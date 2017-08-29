<?php

/**
 * Return the locale data
 *
 * @param string|bool $language - optional, Wished language
 * @return string
 */
function getLocale($language = false)
{
    $dir       = dirname(dirname(dirname(__FILE__)));
    $localeDir = $dir.'/locale/';

    $config = array(
        'steemitUsername' => '',
        'steempiLanguage' => 'en_EN'
    );

    if (file_exists('conf/config.php')) {
        $config = require $dir.'/conf/config.php';
    }


    if ($language !== false) {
        $locale = $localeDir.$language.'.php';

        if (file_exists($locale)) {
            return require $locale;
        }
    }

    if (!isset($config['steempiLanguage'])) {
        return require $localeDir.'en_EN.php';
    }

    $language = $config['steempiLanguage'];
    $locale   = $localeDir.$language.'.php';

    if (file_exists($locale)) {
        return require $locale;
    }

    return require $localeDir.'en_EN.php';
}


/**
 * Return the locale code, if available
 *
 * @param string $language - wanted locale code
 * @return string
 */
function checkLocaleCode($language)
{
    $dir       = dirname(dirname(dirname(__FILE__)));
    $localeDir = $dir.'/locale/';
    $locale    = $localeDir.$language.'.php';

    if (file_exists($locale)) {
        return $language;
    }

    return 'en_EN';
}