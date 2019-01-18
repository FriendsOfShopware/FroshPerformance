<?php

namespace FroshPerformance\Components;

use Shopware\Components\Plugin\ConfigReader;
use Shopware\Models\Shop\Shop;
use Zend_Cache_Core as Cache;

/**
 * Class CachedConfigReader
 */
class CachedConfigReader extends \Shopware\Components\Plugin\CachedConfigReader
{
    /**
     * @var ConfigReader
     */
    private $configReader;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * CachedConfigReader constructor.
     *
     * @param ConfigReader $configReader
     * @param Cache        $cache
     */
    public function __construct(ConfigReader $configReader, Cache $cache)
    {
        $this->configReader = $configReader;
        $this->cache = $cache;
    }

    /**
     * @param string    $pluginName
     * @param Shop|null $shop
     *
     * @throws \Zend_Cache_Exception
     *
     * @return array
     */
    public function getByPluginName($pluginName, Shop $shop = null)
    {
        $key = md5(json_encode([$pluginName, $shop ? $shop->getId() : '']));

        if ($this->cache->test($key)) {
            return $this->cache->load($key, true);
        }

        $config = $this->configReader->getByPluginName($pluginName, $shop);

        $this->cache->save($config, $key, ['Shopware_Config'], 86400);

        return $config;
    }
}
