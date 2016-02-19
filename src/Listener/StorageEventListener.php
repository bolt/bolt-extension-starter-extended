<?php

namespace Bolt\Extension\YourName\ExtensionName\Listener;

use Bolt\Events\StorageEvent;
use Silex\Application;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event class to handle storage related events.
 *
 * @author Your Name <you@example.com>
 */
class StorageEventListener implements EventSubscriberInterface
{
    /** @var Application Bolt's Application object */
    private $app;
    /** @var array The extension's configuration parameters */
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

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [];
    }
}
