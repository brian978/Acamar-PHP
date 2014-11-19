<?php
/**
 * SlimMVC
 *
 * @link https://github.com/brian978/SlimMVC
 * @copyright Copyright (c) 2014
 * @license Creative Commons Attribution-ShareAlike 3.0
 */

namespace Acamar\Mvc\View\Renderer;

use Acamar\Mvc\Event\MvcEvent;
use Acamar\Mvc\View\Renderer\Strategy\RenderingStrategyInterface;
use Acamar\Mvc\View\View;

/**
 * Class ViewRenderer
 *
 * @package Acamar\Mvc\View\Renderer
 */
class ViewRenderer
{
    /**
     * @var RenderingStrategyInterface
     */
    protected $renderingStrategy = null;

    /**
     * @var MvcEvent
     */
    protected $event = null;

    /**
     * @param MvcEvent $event
     */
    public function __construct(MvcEvent $event)
    {
        $this->event = $event;
    }

    /**
     * @param \Acamar\Mvc\View\Renderer\Strategy\RenderingStrategyInterface $renderingStrategy
     * @return $this
     */
    public function setRenderingStrategy(RenderingStrategyInterface $renderingStrategy)
    {
        $this->renderingStrategy = $renderingStrategy;

        return $this;
    }

    /**
     * Renders the data using a rendering strategy
     *
     * @return void
     */
    public function render()
    {
        $view = $this->event->getView();
        if ($view instanceof View) {
            $this->renderingStrategy->setView($view);


            /** @var $application \Acamar\Mvc\Application */
            $application = $this->event->getTarget();
            $config      = $application->getConfig();
            $route       = $this->event->getRoute();

            // Configure the ViewHelperManager
            $viewHelperManager = $view->getViewHelperManager();
            $viewHelperManager->setConfig($config);
            $viewHelperManager->setEvent($this->event);

            // Configure the template
            $view->setTemplatesPath($config['view']['paths'][$route->getModuleName()]);
            $view->setTemplate($route->getControllerName() . '\\' . $route->getActionName());

            $body = $this->renderingStrategy->render();

            $this->event->getResponse()->setBody($body);
        }
    }
}