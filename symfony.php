<?php
/**
 * PHP Command Line Applications
 *
 * @license MIT
 */
require __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Console\Application;
use andrewwoods\phpCliApps\Commands\TalksListingCommand;

$application = new Application('Symfony CLI Example','2017.09.03');
$application->add(new TalksListingCommand());
$application->run();
