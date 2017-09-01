<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';

textdomain('settings');

$Config = \SteemPi\SteemPi::getConfig();

?>
<!DOCTYPE html>

<!-- SteemPi webinterface V2.0 -->
<!-- SteemPi is made by @techtek -->
<!-- SteemPi is made by @dehenne -->

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

<form>
    <?php if (isset($_POST['save'])) { ?>
        <div class="message-save-successfully">
            <?php echo dgettext('settings', 'settings saved successfully'); ?>
        </div>
    <?php } ?>

    <label>
        <span class="label"><?php echo dgettext('settings', 'username'); ?></span>
        <input name="steemitUsername" value="<?php echo $Config->get('steemitUsername'); ?>"/>
    </label>

    <label>
        <span class="label"><?php echo dgettext('settings', 'language'); ?></span>
        <select name="steempiLanguage">
            <option value="en_EN" <?php echo $Config->get('steempiLanguage') == 'en_EN' ? 'selected = "selected"' : ''; ?>>
                <?php echo dgettext('settings', 'language en'); ?>
            </option>
            <option value="de_DE" <?php echo $Config->get('steempiLanguage') == 'de_DE' ? 'selected = "selected"' : ''; ?>>
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