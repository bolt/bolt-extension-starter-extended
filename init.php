<?php

namespace Bolt\Extension\YourName\ExtensionName;

if (isset($app)) {
    $app['extensions']->register(new Extension($app));
}

