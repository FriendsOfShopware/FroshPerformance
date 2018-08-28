<?php

namespace FroshPerformance\Components;

use Shopware\Components\Model\ModelManager;
use Shopware\Components\Theme\PathResolver;
use Shopware\Components\Theme\TimestampPersistor;
use Shopware\Models\Shop\Shop;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class PurifyCss
{
    /**
     * @var string
     */
    private $kernelRootDir;

    /**
     * @var PathResolver
     */
    private $pathResolver;

    /**
     * @var TimestampPersistor
     */
    private $timestampPersistor;

    /**
     * @var ModelManager
     */
    private $manager;

    /**
     * PurifyCss constructor.
     *
     * @param string             $kernelRootDir
     * @param TimestampPersistor $timestampPersistor
     * @param PathResolver       $pathResolver
     * @param ModelManager       $manager
     */
    public function __construct($kernelRootDir, TimestampPersistor $timestampPersistor, PathResolver $pathResolver, ModelManager $manager)
    {
        $this->kernelRootDir = rtrim($kernelRootDir, '/');
        $this->timestampPersistor = $timestampPersistor;
        $this->pathResolver = $pathResolver;
        $this->manager = $manager;
    }

    /**
     * @return bool
     */
    public function isRunnable()
    {
        $finder = new ExecutableFinder();

        return (bool) $finder->find('purifycss');
    }

    /**
     * @param int $shopId
     *
     * @return array
     */
    public function purify($shopId)
    {
        $finder = new ExecutableFinder();
        $timestamp = $this->timestampPersistor->getCurrentTimestamp($shopId);

        $shop = $this->manager->find(Shop::class, $shopId);

        if (!$shop) {
            throw new \RuntimeException(sprintf('Shop with id %d does not exist', $shopId));
        }

        $fileName = $this->pathResolver->buildTimestampName($timestamp, $shop, 'css');
        $filePath = $this->kernelRootDir . '/web/cache/' . $fileName;

        $beforeSize = filesize($filePath);

        $arguments = [
            $this->kernelRootDir . '/themes/**/*.js',
            $this->kernelRootDir . '/themes/**/*.tpl',
            $this->kernelRootDir . '/custom/**/*.js',
            $this->kernelRootDir . '/custom/**/*.tpl',
            $this->kernelRootDir . '/engine/Shopware/Plugins/**/*.tpl',
            $this->kernelRootDir . '/engine/Shopware/Plugins/**/*.js',
            '-m',
        ];

        array_unshift($arguments, $filePath);
        array_unshift($arguments, $finder->find('purifycss'));
        array_unshift($arguments, $finder->find('node'));

        $arguments[] = '-o';
        $arguments[] = $filePath;

        $process = new Process($arguments);
        $process->run();

        if ($process->getExitCode()) {
            throw new \RuntimeException(sprintf('Purify failed with message %s and code %d', $process->getErrorOutput(), $process->getExitCode()));
        }

        $afterSize = filesize($filePath);

        return [$beforeSize, $afterSize];
    }
}
