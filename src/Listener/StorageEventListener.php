<?php

namespace Bolt\Extension\YourName\ExtensionName\Listener;

use Bolt\Application;
use Bolt\Events\StorageEvent;

class StorageEventListener
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
     * Initiate the listener with Bolt Application instance and extension config.
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
     * Handles POST_SAVE storage event
     *
     * @param StorageEvent $event
     */
    public function onPostSave(StorageEvent $event)
    {
        $id = $event->getId(); // record id
        $contenttype = $event->getContentType(); // record contenttype
        $record = $event->getContent(); // record itself
        $created = $event->isCreate(); // if record was created, updated or deleted, for more information look here: https://docs.bolt.cm/extensions/essentials#adding-storage-events
    }

    /**
     * Handles PRE_DELETE storage event
     *
     * @param StorageEvent $event
     */
    public function onPreDelete(StorageEvent $event)
    {
        $id = $event->getId();
        // $contenttype = $event->getContentType(); // You don't get this value at the moment on delete events
        $record = $event->getContent();
    }

    /**
     * Handles POST_DELETE storage event
     *
     * @param StorageEvent $event
     */
    public function onPostDelete(StorageEvent $event)
    {
        $id = $event->getId();
        // $contenttype = $event->getContentType();
        $record = $event->getContent();
    }
}
