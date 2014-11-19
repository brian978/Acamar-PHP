<?php
/**
 * SlimMVC
 *
 * @link https://github.com/brian978/SlimMVC
 * @copyright Copyright (c) 2014
 * @license Creative Commons Attribution-ShareAlike 3.0
 */

namespace Acamar\Mvc\View;

use Acamar\Config\Config;
use Acamar\Config\ConfigAwareInterface;
use Acamar\Event\Event;
use Acamar\Event\EventAwareInterface;

/**
 * Class ViewHelperManager
 *
 * @package Acamar\Mvc\View\Helper
 */
class ViewHelperManager implements ConfigAwareInterface, EventAwareInterface
{
    /**
     * @var Config
     */
    protected $config = null;

    /**
     * @var Event
     */
    protected $event = null;

    /**
     * @var array
     */
    protected static $helpers = array(
        'url' => '\Acamar\Mvc\View\Helper\Url',
    );

    /**
     * @var array
     */
    protected $helperInstances = array();

    /**
     * Inject the configuration object
     *
     * @param Config $config
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Used to inject an Event into the object
     *
     * @param Event $event
     * @return $this
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @param string $name
     * @throws \RuntimeException
     * @return \Acamar\Mvc\View\Helper\HelperInterface
     */
    public function getHelper($name)
    {
        if (isset($this->helperInstances[$name])) {
            return $this->helperInstances[$name];
        }

        if (isset(static::$helpers[$name])) {
            $helper = new static::$helpers[$name];
            if ($helper instanceof ConfigAwareInterface) {
                $helper->setConfig($this->config);
            }

            if ($helper instanceof EventAwareInterface) {
                $helper->setEvent($this->event);
            }

            // Registering the instance
            $this->helperInstances[$name] = $helper;

            return $helper;
        }

        throw new \RuntimeException('Helper "' . $name . '" is not registered');
    }
}