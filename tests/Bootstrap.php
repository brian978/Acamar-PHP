<?php
/**
 * Acamar-Framework
 *
 * @link      https://github.com/brian978/Acamar-Framework
 * @copyright Copyright (c) 2013
 * @license   Creative Commons Attribution-ShareAlike 3.0
 */

use Acamar\Loader\PSR0Autoloader;

$path = realpath(dirname(__DIR__));

include $path . '/Acamar/Loader/PSR0Autoloader.php';

$autoloader = new PSR0Autoloader();
$autoloader->registerNamespaces(array(
    'Acamar' => $path,
    'AcamarTest' => __DIR__,
    'TestHelpers' => __DIR__
));

$autoloader->register();
