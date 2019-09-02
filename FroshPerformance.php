<?php

namespace FroshPerformance;

use FroshPerformance\Components\CompilerPass\AddTemplatePluginDirCompilerPass;
use FroshPerformance\Components\CompilerPass\SetCustomTemplateManager;
use Shopware\Components\Plugin;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class FroshPerformance extends Plugin
{
}
