<?php

/**
 * Checks if a shell command exist
 *
 * @param string $cmd
 * @return bool
 */
function command_exist($cmd)
{
    $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));

    return !empty($return);
}
