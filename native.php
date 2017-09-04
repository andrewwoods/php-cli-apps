<?php
/**
 * PHP Command Line Applications
 *
 * @license MIT
 */

require __DIR__ . "/vendor/autoload.php";

use andrewwoods\phpCliApps\NativeApplication;

$shortOptions = 'hv';
$longOptions = [
    'help',
    'version',
];

$optIndex = null;
$options = getopt($shortOptions, $longOptions, $optIndex);

$arguments = array_slice($argv, $optIndex);

$application = new NativeApplication($options, $arguments);
$application->run();
