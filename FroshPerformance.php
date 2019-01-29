<?php

namespace FroshPerformance;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use FroshPerformance\Components\CompilerPass\AddTemplatePluginDirCompilerPass;
use FroshPerformance\Components\CompilerPass\SetCustomTemplateManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
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
        $container->addCompilerPass(new SetCustomTemplateManager());

        $plugins = $container->getParameter('active_plugins');

        if (!isset($plugins['DneCustomJsCss'])) {
            $loader = new XmlFileLoader(
                $container,
                new FileLocator()
            );

            $loader->load($this->getPath() . '/Resources/services/theme.xml');
        }
    }

    public function install(InstallContext $context)
    {
        if(!$context->assertMinimumVersion('5.4.0')) {
            $context->scheduleMessage('ATTENTION! Do not use ' . $this->getName() . ' below SW 5.4.0');
        }
    }
}
