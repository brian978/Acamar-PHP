<?php
/**
 * Acamar-Framework
 *
 * @link https://github.com/brian978/Acamar-Framework
 * @copyright Copyright (c) 2014
 * @license https://github.com/brian978/Acamar-Framework/blob/master/LICENSE.txt New BSD License
 */

namespace Acamar\Http;

/**
 * Class Request
 *
 * @package Acamar\Http
 */
class Request
{
    const METHOD_HEAD    = 'HEAD';
    const METHOD_GET     = 'GET';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_DELETE  = 'DELETE';
    const METHOD_OPTIONS = 'OPTIONS';

    /**
     * @var Headers
     */
    protected $headers = null;

    /**
     * @var string
     */
    protected $method = '';

    /**
     * @var string
     */
    protected $uri = '';

    /**
     * @var array
     */
    protected $queryParams = [];

    /**
     * @var array
     */
    protected $postParams = [];

    /**
     * @param \Acamar\Http\Headers $headers
     * @return $this
     */
    public function setHeaders(Headers $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return \Acamar\Http\Headers
     */
    public function getHeaders()
    {
        if (null === $this->headers) {
            $this->headers = new Headers();
        }

        return $this->headers;
    }


    /**
     * Sets the HTTP request method
     *
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Returns the HTTP request method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the URI of the request
     *
     * @param string $uri
     * @return $this
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Return the URI that was used for the HTTP request
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Sets the query parameters for the request
     *
     * @param array $params
     * @return $this
     */
    public function setQueryParams(array $params)
    {
        array_map('trim', $params);

        $this->queryParams = $params;

        return $this;
    }

    /**
     * Sets/overwrites a single GET/Query parameter
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setQuery($name, $value)
    {
        if (is_string($name) && (is_string($value) || is_numeric($value))) {
            $this->queryParams[$name] = (string) $value;
        }

        return $this;
    }

    /**
     * Returns a value from the GET/Query parameters based on $name
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getQuery($name, $default = null)
    {
        if (isset($this->queryParams[$name])) {
            return $this->queryParams[$name];
        }

        return $default;
    }

    /**
     * Sets the post parameters for the request
     *
     * @param array $params
     * @return $this
     */
    public function setPostParams(array $params)
    {
        array_map('trim', $params);

        $this->postParams = $params;

        return $this;
    }

    /**
     * Sets/overwrites a single POST parameter
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setPost($name, $value)
    {
        if (is_string($name) && (is_string($value) || is_numeric($value))) {
            $this->postParams[$name] = (string) $value;
        }

        return $this;
    }

    /**
     * Returns a value from the POST parameters based on $name
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getPost($name, $default = null)
    {
        if (isset($this->postParams[$name])) {
            return $this->postParams[$name];
        }

        return $default;
    }
}
