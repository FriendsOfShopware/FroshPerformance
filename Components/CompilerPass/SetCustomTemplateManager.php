<?php

namespace FroshPerformance\Components\CompilerPass;

use FroshPerformance\Components\TemplateManagerFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SetCustomTemplateManager implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $container->getDefinition('template_factory')->setClass(TemplateManagerFactory::class);
    }
}