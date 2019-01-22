<?php

namespace FroshPerformance\Components\Theme;

use Enlight_Event_EventManager;
use Shopware;
use Shopware\Components\Theme\Compiler as BaseCompiler;
use Shopware\Components\Theme\Compressor\CompressorInterface;
use Shopware\Components\Theme\Compressor\Js;
use Shopware\Components\Theme\Inheritance;
use Shopware\Components\Theme\LessCompiler;
use Shopware\Components\Theme\PathResolver;
use Shopware\Components\Theme\Service;
use Shopware\Components\Theme\TimestampPersistor;
use Shopware\Models\Shop;

/**
 * Class Compiler
 *
 * Removes shopware revision from font path
 */
class Compiler extends BaseCompiler
{
    /**
     * @var string
     */
    private $shopwareRoot;

    /**
     * @var PathResolver
     */
    private $resolver;
    /**
     * @var array
     */
    private $pluginConfig;

    /**
     * Compiler constructor.
     *
     * @param $rootDir
     * @param LessCompiler                              $compiler
     * @param PathResolver                              $pathResolver
     * @param Inheritance                               $inheritance
     * @param Service                                   $service
     * @param CompressorInterface                       $jsCompressor
     * @param Enlight_Event_EventManager                $eventManager
     * @param TimestampPersistor                        $timestampPersistor
     * @param Shopware\Components\ShopwareReleaseStruct $releaseStruct
     * @param array                                     $pluginConfig
     */
    public function __construct(
        $rootDir,
        LessCompiler $compiler,
        PathResolver $pathResolver,
        Inheritance $inheritance,
        Service $service,
        CompressorInterface $jsCompressor,
        Enlight_Event_EventManager $eventManager,
        TimestampPersistor $timestampPersistor,
        Shopware\Components\ShopwareReleaseStruct $releaseStruct,
        array $pluginConfig
    ) {
        $this->shopwareRoot = $rootDir;
        $this->resolver = $pathResolver;
        parent::__construct($rootDir, $compiler, $pathResolver, $inheritance, $service, $jsCompressor, $eventManager, $timestampPersistor, $releaseStruct);
        $this->pluginConfig = $pluginConfig;
    }

    /**
     * @param Shop\Shop $shop
     * @param int       $timestamp
     */
    public function createThemeTimestamp(Shop\Shop $shop, $timestamp)
    {
        if ($this->pluginConfig['removeShopwareRevisionFromFont']) {
            $fileName = $this->resolver->buildTimestampName($timestamp, $shop, 'css');
            $path = $this->shopwareRoot . '/web/cache/' . $fileName;

            $invalidQuerys = [
                '?' . Shopware::REVISION,
                '?#' . Shopware::REVISION,
            ];

            if (file_exists($path)) {
                file_put_contents($path, str_replace($invalidQuerys, '', file_get_contents($path)));
            }
        }

        parent::createThemeTimestamp($shop, $timestamp);
    }
}
