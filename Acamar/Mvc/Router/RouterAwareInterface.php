<?php
/**
 * SlimMVC
 *
 * @link https://github.com/brian978/SlimMVC
 * @copyright Copyright (c) 2014
 * @license Creative Commons Attribution-ShareAlike 3.0
 */

namespace Acamar\Mvc\Router;

/**
 * Interface RouterAwareInterface
 *
 * @package Acamar\Mvc\Router
 */
interface RouterAwareInterface
{
    /**
     * Injects the router in the object
     *
     * @param Router $router
     * @return mixed
     */
    public function setRouter(Router $router);
} 
