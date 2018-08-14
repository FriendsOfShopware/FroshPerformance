<?php

namespace FroshPerformance\Subscriber;

use Enlight\Event\SubscriberInterface;

/**
 * Class TemplateSubscriber
 */
class TemplateSubscriber implements SubscriberInterface
{
    /**
     * @var string
     */
    private $viewDir;

    /**
     * TemplateSubscriber constructor.
     *
     * @param $viewDir
     */
    public function __construct($viewDir)
    {
        $this->viewDir = $viewDir;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Theme_Inheritance_Template_Directories_Collected' => 'onCollectThemeDirectories',
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return array
     */
    public function onCollectThemeDirectories(\Enlight_Event_EventArgs $args)
    {
        $list = $args->getReturn();

        $list[] = $this->viewDir;

        return $list;
    }
}
