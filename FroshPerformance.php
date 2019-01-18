<?php

namespace FroshPerformance;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use FroshPerformance\Components\CompilerPass\AddTemplatePluginDirCompilerPass;
use FroshPerformance\Components\CompilerPass\SetCustomTemplateManager;
use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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
    }
}
