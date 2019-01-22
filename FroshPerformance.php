<?php

namespace FroshPerformance;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use FroshPerformance\Components\CompilerPass\AddTemplatePluginDirCompilerPass;
use Shopware\Components\Plugin;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class FroshPerformance
 */
class FroshPerformance extends Plugin
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AddTemplatePluginDirCompilerPass());

        $plugins = $container->getParameter('active_plugins');

        if (!isset($plugins['DneCustomJsCss'])) {
            $loader = new XmlFileLoader(
                $container,
                new FileLocator()
            );

            $loader->load($this->getPath() . '/Resources/services/theme.xml');
        }
    }
}
