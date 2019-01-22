<?php

class HtmlMinTest extends Enlight_Components_Test_Controller_TestCase
{
    const PATTERN = '#(?ix)(?>[^\S ]\s*|\s{2,})(?=(?:(?:[^<]++|<(?!/?(?:textarea|pre|script)\b))*+)(?:<(?>textarea|pre|script)\b|\z))#';

    public function testHomePage()
    {
        $this->dispatch('/');

        $body = $this->Response()->getBody();

        $this->assertContains('<!DOCTYPE html> <html class="no-js" lang="de" itemscope="itemscope" itemtype="http://schema.org/WebPage">', $body, 'Is minified');
    }

    public function testRobotsTxt()
    {
        $this->dispatch('/robots.txt');

        $minified = preg_replace(self::PATTERN, '', $this->Response()->getBody());

        $this->assertNotEquals($this->Response()->getBody(), $minified);
    }

    public function testSitemapIndex()
    {
        if (!class_exists('\Shopware\Bundle\SitemapBundle\Controller\SitemapIndexXml')) {
            $this->markTestSkipped('Sitemap Index not implemented in this Version');

            return;
        }

        $this->dispatch('/sitemap_index.xml');

        $minified = preg_replace(self::PATTERN, '', $this->Response()->getBody());

        $this->assertNotEquals($this->Response()->getBody(), $minified);
    }

    public function testSitemap()
    {
        if (class_exists('\Shopware\Bundle\SitemapBundle\Controller\SitemapIndexXml')) {
            $this->markTestSkipped('Sitemap.xml does only redirects in this version');

            return;
        }

        $this->dispatch('/sitemap.xml');

        $minified = preg_replace(self::PATTERN, '', $this->Response()->getBody());

        $this->assertNotEquals($this->Response()->getBody(), $minified);
    }
}
