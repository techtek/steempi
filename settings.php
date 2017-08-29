<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'lib/utils/config.php';
require 'lib/utils/language.php';

$config = array(
    'steemitUsername' => '',
    'steempiLanguage' => 'en_EN'
);

if (file_exists('conf/config.php')) {
    $config = require 'conf/config.php';
}

$locale = getLocale();

// saving
if (isset($_POST['save'])) {
    // steemit username
    $steemitUsername = $_POST['steemitUsername'];
    $steemitUsername = str_replace('@', '', $steemitUsername);
    $steemitUsername = preg_replace('/[^a-zA-Z0-9\-]/i', '', $steemitUsername);

    if (!empty($steemitUsername)) {
        $config['steemitUsername'] = $steemitUsername;
    }

    // steempi language
    $config['steempiLanguage'] = $_POST['steempiLanguage'];

    // save config
    $config = saveConfig($config);
    $locale = getLocale($config['steempiLanguage']);
}

?>
<!-- SteemPi webinterface V1.0 -->
<!-- SteemPi is made by @techtek -->
<!-- SteemPi is made by @dehenne -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>STEEMPI | A system for Steemit</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/settings.css" type="text/css" media="screen"/>
</head>
<body>

<header>
    <div style="text-align: center">
        <a href="/">
            <img border="0" alt="SteemPi" src="/img/logosteempi.png">
        </a>
    </div>
</header>

<section class="container">
    <form name="settings" method="post" action="settings.php">

        <?php if (isset($_POST['save'])) { ?>
            <div class="message-save-successfully">
                <?php echo $locale['settings.message.saved.successfully']; ?>
            </div>
        <?php } ?>

        <label>
            <span class="label"><?php echo $locale['settings.username']; ?></span>
            <input name="steemitUsername" value="<?php echo $config['steemitUsername']; ?>"/>
        </label>

        <label>
            <span class="label"><?php echo $locale['settings.language']; ?></span>
            <select name="steempiLanguage">
                <option value="en_EN" <?php echo $config['steempiLanguage'] == 'en_EN' ? 'selected="selected"' : ''; ?>>
                    <?php echo $locale['settings.language.en_EN']; ?>
                </option>
                <option value="de_DE" <?php echo $config['steempiLanguage'] == 'de_DE' ? 'selected="selected"' : ''; ?>>
                    <?php echo $locale['settings.language.de_DE']; ?>
                </option>
            </select>
        </label>

        <button type="submit" name="save">
            <?php echo $locale['settings.save.button']; ?>
        </button>
    </form>
</section>

</body>
</html>