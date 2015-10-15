<?php
/**
 * Created by PhpStorm.
 * User: phillipp
 * Date: 15.10.15
 * Time: 23:27
 */

namespace Bolt\Extension\YourName\ExtensionName\Controllers;


use Bolt\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExampleController
{
    /**
     * Bolt Application instance
     *
     * @var Application
     */
    private $app;

    /**
     * Extension configuration
     *
     * @var array
     */
    private $config;

    function __construct(Application $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    /**
     * Handles GET requests on /example/url/in/controller
     */
    public function exampleUrl()
    {
        // do something
    }

    /**
     * Handles GET requests on /example/url/json and return with json.
     */
    public function exampleUrlJson()
    {
        $jsonResponse = new JsonResponse();

        $jsonResponse->setData([
            'message' => 'I am a JSON response, yeah!'
        ]);

        return $jsonResponse;
    }

    /**
     * Handles GET requests on /example/url/parameter/{id} and return with json.
     */
    public function exampleUrlWithParameter($id)
    {
        $jsonResponse = new JsonResponse();

        $jsonResponse->setData([
            'id' => $id
        ]);

        return $jsonResponse;
    }
}