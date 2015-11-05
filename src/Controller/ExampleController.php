<?php

namespace Bolt\Extension\YourName\ExtensionName\Controller;

use Bolt\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExampleController implements ControllerProviderInterface
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

    /**
     * Initiate the controller with Bolt Application instance and extension config.
     *
     * @param Application $app
     * @param $config
     */
    public function __construct(Application $app, array $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    /**
     * Specify which method handles which route.
     *
     * Base route/path is '/example/url' (see Extension.php)
     *
     * @param \Silex\Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(\Silex\Application $app)
    {
        /** @var $ctr \Silex\ControllerCollection */
        $ctr = $app['controllers_factory'];

        // /example/url/in/controller
        $ctr->get('/in/controller', array($this, 'exampleUrl'))
            ->bind('example-url-controller'); // route name, must be unique(!)

        // /example/url/json
        $ctr->get('/json', array($this, 'exampleUrlJson'))
            ->bind('example-url-json');

        // /example/url/parameter/{id}
        $ctr->get('/parameter/{id}', array($this, 'exampleUrlWithParameter'))
            ->bind('example-url-parameter');

        // /example/url/get-parameter
        $ctr->get('/get-parameter', array($this, 'exampleUrlGetParameter'))
            ->bind('example-url-parameter-get');

        return $ctr;
    }

    /**
     * Handles GET requests on /example/url/in/controller
     *
     * @param Request $request
     *
     * @return Response
     */
    public function exampleUrl(Request $request)
    {
        $response = new Response('Hello, World!', Response::HTTP_OK);

        return $response;
    }

    /**
     * Handles GET requests on /example/url/json and return with json.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function exampleUrlJson(Request $request)
    {
        $jsonResponse = new JsonResponse();

        $jsonResponse->setData([
            'message' => 'I am a JSON response, yeah!'
        ]);

        return $jsonResponse;
    }

    /**
     * Handles GET requests on /example/url/parameter/{id} and return with json.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function exampleUrlWithParameter(Request $request, $id)
    {
        $jsonResponse = new JsonResponse();

        $jsonResponse->setData([
            'id' => $id
        ]);

        return $jsonResponse;
    }

    /**
     * Handles GET requests on /example/url/get-parameter and return with some data as json.
     * Example: http://localhost/example/url/get-parameter?foo=bar&baz=foo&id=7
     * Works in the same way with POST requests
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function exampleUrlGetParameter(Request $request)
    {
        $jsonResponse = new JsonResponse();

        $jsonResponse->setData([
            'all' => $request->query->all(), // all GET parameter as key value array
            'id' => $request->get('id') // only 'id' GET parameter
        ]);

        return $jsonResponse;
    }
}
