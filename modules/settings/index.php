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

include "save.php";
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

<div class="body-container">
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
                    <option value="nl_NL"
                        <?php echo $Config->get('steempi', 'language') == 'nl_NL' ? 'selected = "selected"' : ''; ?>
                    >
                        <?php echo dgettext('settings', 'language nl'); ?>
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

        <?php

        foreach ($modules as $Module) {
            /* @var $Module \SteemPi\Modules\Module */
            if (!$Module->hasSettingsTemplateData()) {
                continue;
            }

            ?>
            <section class="settings-container">
                <header><?php echo $Module->getTitle(); ?></header>
                <div class="settings-container-display">
                    <?php echo $Module->renderSettings(); ?>
                </div>
            </section>
            <?php
        }

        ?>

        <section class="settings-save">
            <button type="submit" name="save">
                <?php echo dgettext('settings', 'save'); ?>
            </button>
        </section>
    </form>
</div>

</body>
</html>