<?php

namespace FroshPerformance\Subscriber;

use Enlight\Event\SubscriberInterface;
use Enlight_Event_EventArgs;

/**
 * Class MinifyHtmlSubscriber
 */
class MinifyHtmlSubscriber implements SubscriberInterface
{
    /**
     * @var array
     */
    private $pluginConfig;

    /**
     * MinifyHtmlSubscriber constructor.
     *
     * @param array $pluginConfig
     */
    public function __construct(array $pluginConfig)
    {
        $this->pluginConfig = $pluginConfig;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onPreDispatch',
            'Enlight_Controller_Action_PostDispatch_Widgets' => 'onPreDispatch',
        ];
    }

    /**
     * @param Enlight_Event_EventArgs $args
     *
     * @throws \SmartyException
     */
    public function onPreDispatch(Enlight_Event_EventArgs $args)
    {
        if (!$this->pluginConfig['minifyHtml']) {
            return;
        }

        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->getSubject();

        $controller->View()->Engine()->loadFilter('output', 'minify');
    }
}
