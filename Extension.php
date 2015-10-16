<?php

namespace Bolt\Extension\YourName\ExtensionName;

use Bolt\Application;
use Bolt\BaseExtension;
use Bolt\Extension\YourName\ExtensionName\Controller\ExampleController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Extension extends BaseExtension
{
    public function initialize()
    {
        $this->app->before(array($this, 'before'));

        /*
         * Routes:
         * Here you can register new routes in your Bolt application.
         * The first route will be handles in this Extension class,
         * then we switch to an extra Controller class for the routes.
         * */

        // register route for all GET requests on '/example/url' that will be handled in this class ($this) in the 'routeExampleUrl' function.
        $this->app
            ->get("/example/url", array($this, 'routeExampleUrl'))
            ->bind('example-url');

        // Mount the ExampleController class to all routes that match '/example/url/*'
        // To see specific bindings between route and controller method see 'connect()' function in the ExampleController class.
        $this->app->mount('/example/url', new ExampleController($this->app, $this->config));

    }

    public function getName()
    {
        return "ExtensionName";
    }

    /**
     * Before middleware function.
     */
    public function before()
    {
        // add CSS and Javascript files to all requests
        $this->addCss('assets/extension.css');
        $this->addJavascript('assets/start.js', true);
    }

    /**
     * Handles GET requests on /example/url
     *
     * @param Request $request
     *
     * @return Response
     */
    public function routeExampleUrl(Request $request)
    {
        $response = new Response('Hello, Bolt!', Response::HTTP_OK);

        return $response;
    }
}

