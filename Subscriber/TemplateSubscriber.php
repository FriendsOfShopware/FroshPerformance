<?php

namespace FroshPerformance\Subscriber;

use Doctrine\Common\Collections\ArrayCollection;
use Enlight\Event\SubscriberInterface;
use Shopware\Components\Plugin\ConfigReader;

/**
 * Class TemplateSubscriber
 */
class TemplateSubscriber implements SubscriberInterface
{
    /**
     * @var string
     */
    private $emotionNoAjaxViewDir;

    /**
     * @var string
     */
    private $version;

    /**
     * @var array
     */
    private $configReader;

    /**
     * @var boolean
     */
    private $emotionPreLoading;

    /**
     * TemplateSubscriber constructor.
     *
     * @param string       $emotionNoAjaxViewDir
     * @param string       $version
     * @param ConfigReader $configReader
     */
    public function __construct($emotionNoAjaxViewDir, $version, ConfigReader $configReader)
    {
        $this->emotionNoAjaxViewDir = $emotionNoAjaxViewDir;
        $this->version = $version;
        $this->configReader = $configReader;
        $this->emotionPreLoading = false;

        if (version_compare($this->version, '5.6.0', '<')) {
            $this->emotionPreLoading = $this->configReader->getByPluginName('FroshPerformance')['NoAjaxEmotionLoading'];
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Theme_Compiler_Collect_Plugin_Javascript' => 'onCollectJavascriptFiles',
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return ArrayCollection
     */
    public function onCollectJavascriptFiles(\Enlight_Event_EventArgs $args)
    {
        $collection = new ArrayCollection();

        if ($this->emotionPreLoading) {
            $collection->add($this->emotionNoAjaxViewDir . '/frontend/_public/js/jquery.emotion.js');
        }

        return $collection;
    }
}
