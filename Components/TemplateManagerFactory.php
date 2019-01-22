<?php

namespace FroshPerformance\Components;

use Enlight_Components_Snippet_Resource;
use Enlight_Event_EventManager;
use Shopware\Components\Escaper\EscaperInterface;
use Shopware\Components\Template\Security;
use Smarty;

class TemplateManagerFactory
{
    /**
     * @param Enlight_Event_EventManager $eventManager
     * @param Enlight_Components_Snippet_Resource $snippetResource
     * @param EscaperInterface $escaper
     * @param array $templateConfig
     * @param array $securityConfig
     * @param array $backendOptions
     */
    public function factory(
        Enlight_Event_EventManager $eventManager,
        Enlight_Components_Snippet_Resource $snippetResource,
        EscaperInterface $escaper,
        array $templateConfig,
        array $securityConfig,
        array $backendOptions = []
    ) {
        /** @var \Enlight_Template_Manager $template */
        $template = \Enlight_Class::Instance(TemplateManager::class, [null, $backendOptions]);

        $template->enableSecurity(
            new Security($template, $securityConfig)
        );

        $template->setOptions($templateConfig);
        $template->setEventManager($eventManager);

        $template->registerResource('snippet', $snippetResource);
        $template->setDefaultResourceType('snippet');

        $template->registerPlugin(Smarty::PLUGIN_MODIFIER, 'escapeHtml', [$escaper, 'escapeHtml']);
        $template->registerPlugin(Smarty::PLUGIN_MODIFIER, 'escapeHtmlAttr', [$escaper, 'escapeHtmlAttr']);
        $template->registerPlugin(Smarty::PLUGIN_MODIFIER, 'escapeJs', [$escaper, 'escapeJs']);
        $template->registerPlugin(Smarty::PLUGIN_MODIFIER, 'escapeCss', [$escaper, 'escapeCss']);
        $template->registerPlugin(Smarty::PLUGIN_MODIFIER, 'escapeUrl', [$escaper, 'escapeUrl']);

        return $template;
    }
}
