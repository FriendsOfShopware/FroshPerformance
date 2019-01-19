<?php

namespace FroshPerformance\Components;

use Enlight_Template_Manager;

class TemplateManager extends Enlight_Template_Manager
{
    /**
     * @var bool
     */
    private $folderAdded = false;

    /**
     * We need to be after Bare in the hierarchy, cause we have to overwrite a block without calling the {$smarty.block.parent}
     * We could sort the Template Folders of the Plugins, so we are the first one. But that issue could be also in Themes
     * This is currently in Shopware the only way to sort a Plugin folder between Bare and Responsive
     *
     * @param string[] $themeDirectories
     * @param string[] $pluginDirs
     * @return string[]
     */
    public function buildInheritance($themeDirectories, $pluginDirs)
    {
        $inheritance = parent::buildInheritance($themeDirectories, $pluginDirs);

        if ($this->folderAdded) {
            foreach ($inheritance as $key => $templateFolder) {
                if (strpos($templateFolder, 'FroshPerformance') !== false) {
                    unset($inheritance[$key]);
                }
            }

            $inheritance = array_values($inheritance);
        }

        $folders = [];

        foreach ($inheritance as $templateFolder) {
            if (basename($templateFolder) === 'Bare') {
                $folders[] = dirname(__DIR__) . '/Resources/views';
                $folders[] = $templateFolder;
            } else {
                $folders[] = $templateFolder;
            }
        }

        $this->folderAdded = true;

        return $folders;
    }
}