<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';

textdomain('settings');

$Config      = \SteemPi\SteemPi::getConfig();
$configSaved = false;

if (isset($_POST['save'])) {
    unset($_POST['save']);
    // @todo create a setting class
    // @todo saving the settings must be outsourced

    // steemit username
    $steemitUsername = $_POST['steemitUsername'];
    $steemitUsername = str_replace('@', '', $steemitUsername);
    $steemitUsername = preg_replace('/[^a-zA-Z0-9\-]/i', '', $steemitUsername);

    if (!empty($steemitUsername)) {
        $Config->set('steemit', 'username', $steemitUsername);
    }

    // steempi language
    $Config->set('steempi', 'language', $_POST['steempiLanguage']);

    // save config
    $Config->save();

    \SteemPi\SteemPi::loadLanguage();

    $configSaved = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>STEEMPI | A system for Steemit</title>

    <meta charset="utf-8"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../app/css/font-awesome/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>

<form method="POST" action="">
    <?php if ($configSaved) { ?>
        <div class="message-save-successfully">
            <?php echo dgettext('settings', 'settings saved successfully'); ?>
            <script>
                setTimeout(function () {
                    window.parent.location.reload();
                }, 5000);
            </script>
        </div>
    <?php } ?>

    <label>
        <span class="label"><?php echo dgettext('settings', 'username'); ?></span>
        <input name="steemitUsername" value="<?php echo $Config->get('steemit', 'username'); ?>"/>
    </label>

    <label>
        <span class="label"><?php echo dgettext('settings', 'language'); ?></span>
        <select name="steempiLanguage">
            <option value="en_EN"
                <?php echo $Config->get('steempi', 'language') == 'en_EN' ? 'selected = "selected"' : ''; ?>
            >
                <?php echo dgettext('settings', 'language en'); ?>
            </option>
            <option value="de_DE"
                <?php echo $Config->get('steempi', 'language') == 'de_DE' ? 'selected = "selected"' : ''; ?>
            >
                <?php echo dgettext('settings', 'language de'); ?>
            </option>
        </select>
    </label>

    <button type="submit" name="save">
        <?php echo dgettext('settings', 'save'); ?>
    </button>
</form>

</body>
</html>