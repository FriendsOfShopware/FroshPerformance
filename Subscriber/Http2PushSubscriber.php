<?php

namespace FroshPerformance\Subscriber;

use Enlight\Event\SubscriberInterface;
use Enlight_Event_EventArgs;
use Psr\Link\LinkProviderInterface;
use Symfony\Component\WebLink\HttpHeaderSerializer;

/**
 * Class Http2PushSubscriber
 */
class Http2PushSubscriber implements SubscriberInterface
{
    /**
     * @var HttpHeaderSerializer
     */
    private $serializer;
    /**
     * @var array
     */
    private $pluginConfig;

    /**
     * AddLinkHeaderSubscriber constructor.
     *
     * @param array $pluginConfig
     */
    public function __construct(array $pluginConfig)
    {
        $this->serializer = new HttpHeaderSerializer();
        $this->pluginConfig = $pluginConfig;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Front_DispatchLoopShutdown' => 'onDispatchLoopShutdown',
        ];
    }

    /**
     * @param Enlight_Event_EventArgs $args
     */
    public function onDispatchLoopShutdown(Enlight_Event_EventArgs $args)
    {
        if (!$this->pluginConfig['http2Push']) {
            return;
        }

        /** @var \Enlight_Controller_Request_Request $request */
        $request = $args->get('request');
        /** @var \Enlight_Controller_Response_Response $response */
        $response = $args->get('response');

        if ($linkProvider = $request->getParam('_links')) {
            if (!$linkProvider instanceof LinkProviderInterface || !$links = $linkProvider->getLinks()) {
                return;
            }
            $response->setHeader('Link', $this->serializer->serialize($links));
        }
    }
}
