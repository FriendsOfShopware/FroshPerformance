<?php

class TemplateInheritanceTest extends Enlight_Components_Test_Controller_TestCase
{
    const PATTERN = '#(?ix)(?>[^\S ]\s*|\s{2,})(?=(?:(?:[^<]++|<(?!/?(?:textarea|pre|script)\b))*+)(?:<(?>textarea|pre|script)\b|\z))#';

    public function testTemplateDirs()
    {
        $this->dispatch('/');

        $templateFolders = array_values($this->View()->Engine()->getTemplateDir());

        $this->assertContains('Responsive', $templateFolders[count($templateFolders) - 3]);
        $this->assertContains('FroshPerformance', $templateFolders[count($templateFolders) - 2]);
        $this->assertContains('Bare', $templateFolders[count($templateFolders) - 1]);
    }
}
