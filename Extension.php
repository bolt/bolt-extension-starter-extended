<?php

namespace Bolt\Extension\YourName\ExtensionName;

use Bolt\Application;
use Bolt\BaseExtension;
use Bolt\Extension\YourName\ExtensionName\Controllers\ExampleController;

class Extension extends BaseExtension
{
    public function initialize()
    {
        $this->addCss('assets/extension.css');
        $this->addJavascript('assets/start.js', true);

        /*
         * Routes:
         * Here you can register new routes in your Bolt application.
         * The first route will be handles in this Extension class,
         * then we switch to an extra Controller class for the routes.
         * */

        // register route for all GET requests on '/example/url' that will be handled in this class ($this) in the 'routeExampleUrl' function
        $this->app->get("/example/url", array($this, 'routeExampleUrl'))->bind('example-url');

        // new instance of our example Controller
        $exampleController = new ExampleController($this->app, $this->config);

        // register route for all GET requests on '/example/url/in/controller' that will be handled in the ExampleController class in the 'exampleUrl' function
        $this->app->get("/example/url/in/controller", array($exampleController, 'exampleUrl'))->bind('example-url-controller');

        // {we register a new route stuff from below} ... and return a JSON string as response.
        $this->app->get("/example/url/json", array($exampleController, 'exampleUrlJson'))->bind('example-url-json');

        // {we register a new route stuff from below} ... with an url parameter whose value will be returned as a JSON response.
        $this->app->get("/example/url/parameter/{id}", array($exampleController, 'exampleUrlWithParameter'))->bind('example-url-parameter');
    }

    public function getName()
    {
        return "ExtensionName";
    }

    /**
     * Handles GET requests on /example/url
     */
    public function routeExampleUrl()
    {
        // do something
    }
}
