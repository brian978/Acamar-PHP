<?php
/**
 * Acamar-Framework
 *
 * @link https://github.com/brian978/Acamar-Framework
 * @copyright Copyright (c) 2014
 * @license https://github.com/brian978/Acamar-Framework/blob/master/LICENSE.txt New BSD License
 */

namespace Acamar\Mvc\View\Renderer\Strategy;

use Acamar\Http\Headers;

/**
 * Class JsonStrategy
 *
 * @package Acamar\Mvc\View\Renderer
 */
class JsonStrategy extends AbstractRenderingStrategy implements RenderingStrategyInterface
{
    /**
     * Renders the View and returns the rendered content
     *
     * @return string
     */
    public function render()
    {
        $response = $this->event->getResponse();

        // Updating the response headers to match the type of content
        $response->getHeaders()->set(Headers::CONTENT_TYPE, 'text/json');

        // Clear all from response to avoid breaking the JSON
        $response->setBody('');

        return json_encode($this->view->toArray());
    }
}
