<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';

textdomain('settings');

use SteemPi\SteemPi;

$Config  = SteemPi::getConfig();
$Modules = SteemPi::getModuleHandler();

$modules      = $Modules->getModules();
$modulesCount = $Modules->getLength();

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

    // steempi module status
    if (isset($_POST['modulesStatus'])) {
        $status = $_POST['modulesStatus'];
        /* @var $Module \SteemPi\Modules\Module */
        foreach ($modules as $Module) {
            if ($Module->getName() === 'settings') {
                $Module->activate();
                continue;
            }

            if (in_array($Module->getName(), $status)) {
                $Module->activate();
                continue;
            }

            $Module->deactivate();
        }
    }

    // steempi module order
    if (isset($_POST['moduleOrder'])) {
        asort($_POST['moduleOrder']);
        $keys = array_keys($_POST['moduleOrder']);

        $Config->set('steempi', 'modulesOrder', implode(',', $keys));

        //refresh modules
        $modules = $Modules->getModules();
    }

    // save config
    $Config->save();

    SteemPi::loadLanguage();

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

    <section class="settings-container">
        <header><?php echo dgettext('settings', 'main settings'); ?></header>
        <label>
            <span class="label"><?php echo dgettext('settings', 'username'); ?></span>
            <input name="steemitUsername" type="text" value="<?php echo $Config->get('steemit', 'username'); ?>"/>
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
    </section>

    <section class="settings-container">
        <header><?php echo dgettext('settings', 'module activation status'); ?></header>
        <?php

        /* @var $Module \SteemPi\Modules\Module */
        foreach ($modules as $Module) {
            if ($Module->getName() === 'settings') {
                continue;
            }
            ?>
            <label>
                <span class="label"><?php echo $Module->getTitle(); ?></span>
                <input type="checkbox"
                       name="modulesStatus[]"
                       value="<?php echo $Module->getName(); ?>"
                    <?php
                    if ($Module->isActive()) {
                        echo ' checked';
                    }
                    ?>
                />
            </label>
            <?php
        }

        ?>
    </section>

    <section class="settings-container">
        <header><?php echo dgettext('settings', 'module order'); ?></header>
        <?php

        $mc = 1;

        foreach ($modules as $Module) {
            /* @var $Module \SteemPi\Modules\Module */
            ?>
            <label>
                <span class="label"><?php echo $Module->getTitle(); ?></span>
                <select name="moduleOrder[<?php echo $Module->getName(); ?>]">
                    <?php for ($i = 1; $i <= $modulesCount; $i++) { ?>
                        <option value="<?php echo $i; ?>"
                            <?php
                            if ($i === $mc) {
                                echo ' selected';
                            }
                            ?>
                        >
                            <?php echo $i; ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <?php

            $mc++;
        }

        ?>
    </section>

    <section class="settings-save">
        <button type="submit" name="save">
            <?php echo dgettext('settings', 'save'); ?>
        </button>
    </section>
</form>

</body>
</html>