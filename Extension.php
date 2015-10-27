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

        // execute only when in backend
        if ($this->app['config']->getWhichEnd() === 'backend') {
            $this->app['htmlsnippets'] = true;
            $this->app['twig.loader.filesystem']->addPath(__DIR__ . '/twig'); //register folder as additional twig source
        }

        /*
         * Extension config file:
         * You extension can have its own config file where your users can set some options
         * through the Bolt backend or any text editor.
         * Look at the file named config.yml.dist which is your config boilerplate.
         * You can edit it like you want so it fits your needs.
         * Bolt will copy it as {extension-name}.{vendor-name}.yml into /app/config/extensions when it doesn’t already exist there.
         * See also the section in the docs: https://docs.bolt.cm/extensions/essentials#using-your-own-configyml-file
         * */

        // dump the whole config on top of each page for debugging purpose
        //dump($this->config);

        // it's just a normal array
        $foo = $this->config['foo'];

        /*
         * Global application config:
         * You can also access the global application config.
         * There is a useful getter on the configuration object to access the different configuration file.
         * Struktur: get({file}/{key}/{subkey});
         * Unclear? Check out the following examples.
         * */

        $theme = $this->app['config']->get('general/theme', 'default'); // File 'config.yml', Key 'theme'

        $pagesContenttype = $this->app['config']->get('contenttypes/pages', 'default'); // File 'contenttypes.yml', Key 'pages'

        $mainMenuFirstItem = $this->app['config']->get('menu/main/0', 'default'); // File 'menu.yml', Key 'main', SubKey 0

        $roles = $this->app['config']->get('permissions/roles', 'default'); // File 'permissions.yml', Key 'roles'


        /*
         * Own Twig functions:
         * You can define methods inside this class as Twig functions.
         * How to use the following example in your template: {{ add_five_to(7) }}
         * It will display '12'.
         * */

        $this->addTwigFunction(
            'add_five_to', // Twig function name
            'addFiveTo'  // Method in this class (scroll down buddy)
        );

        /*
         * Own Fieldtypes:
         * You are not limited to the fieldtypes that are served by Bolt.
         * It's really easy to create your own.
         *
         * This example is just a simple textfield to show you
         * how to store and receive data.
         *
         * See also the documentation page for more information and a more complex example.
         * https://docs.bolt.cm/extensions/customfields
         * */

        $this->app['config']->getFields()->addField(new Field\ExampleField());

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

    /**
     * The extension name
     *
     * @return string
     */
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

    /**
     * Add 5 to the given number
     *
     * @param $number
     *
     * @return int
     */
    public function addFiveTo($number)
    {
        return intval($number) + 5;
    }
}
