<?php
/**
 * Acamar-Framework
 *
 * @link https://github.com/brian978/Acamar-Framework
 * @copyright Copyright (c) 2014
 * @license https://github.com/brian978/Acamar-Framework/blob/master/LICENSE.txt New BSD License
 */

namespace AcamarTest\Http\Cgi;

use Acamar\Http\Cgi\Request;

/**
 * Class RequestTest
 *
 * @package AcamarTest\Http\Cgi
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * this is used to simulate the $_SERVER super global
     *
     * @return array
     */
    public function serverDataProvider()
    {
        $server = require realpath(__DIR__ . '/_files/server.php');

        return array(
            array($server)
        );
    }

    /**
     * @param array $server
     * @dataProvider serverDataProvider
     * @covers Request::getMethod
     */
    public function testCanGetRequestMethod(array $server)
    {
        $request = new Request($server);

        $this->assertEquals('GET', $request->getMethod());
    }

    /**
     * @param array $server
     * @dataProvider serverDataProvider
     * @covers Request::setPathInfo
     */
    public function testCanGetUri(array $server)
    {
        $request = new Request($server);

        $this->assertEquals('/controller/action', $request->getUri());
    }

    /**
     * @param array $server
     * @dataProvider serverDataProvider
     * @covers Request::setPathInfo
     */
    public function testCanGetUriWithRootBaseFolder(array $server)
    {
        // The query string must also be present in the REQUEST_URI
        $server['SCRIPT_NAME'] = '/index.php';
        $server['REQUEST_URI'] = '/controller/action?test=1';

        $request = new Request($server);

        $this->assertEquals('/controller/action', $request->getUri());
    }

    /**
     * @param array $server
     * @dataProvider serverDataProvider
     * @covers Request::setPathInfo
     */
    public function testCanGetUriWithRootBaseFolderAndNoQueryString(array $server)
    {
        // The query string must also be present in the REQUEST_URI
        $server['SCRIPT_NAME'] = '/index.php';
        $server['REQUEST_URI'] = '/controller/action';
        $server['QUERY_STRING'] = '';

        $request = new Request($server);

        $this->assertEquals('/controller/action', $request->getUri());
    }

    /**
     * @param array $server
     * @dataProvider serverDataProvider
     * @covers Request::setPathInfo
     */
    public function testCanGetUriFromRoot(array $server)
    {
        // The query string must also be present in the REQUEST_URI
        $server['SCRIPT_NAME'] = '/index.php';
        $server['REQUEST_URI'] = '/';
        $server['QUERY_STRING'] = '';

        $request = new Request($server);

        $this->assertEquals('/', $request->getUri());
    }

    /**
     * @param array $server
     * @dataProvider serverDataProvider
     * @covers RemoteAddress::getResolved
     */
    public function testCanGetRemoteAddress(array $server)
    {
        $request = new Request($server);

        $this->assertEquals('127.0.0.1', $request->getIp());
    }
}
