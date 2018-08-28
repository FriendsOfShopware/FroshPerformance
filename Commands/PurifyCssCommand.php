<?php

namespace FroshPerformance\Commands;

use Shopware\Commands\ShopwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PurifyCssCommand extends ShopwareCommand
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $purify = $this->container->get('frosh_performance.components.purify_css');
        $io = new SymfonyStyle($input, $output);

        if (!$purify->isRunnable()) {
            $io->error('Please install first purify-css');
            exit(1);
        }

        list($before, $after) = $this->container->get('frosh_performance.components.purify_css')->purify($input->getArgument('shopId'));

        $io->success(sprintf('Purified css from %s to %s', $this->humanFilesize($before), $this->humanFilesize($after)));
    }

    protected function configure()
    {
        $this
            ->setName('frosh:purify:css')
            ->setDescription('Removes unused css styles')
            ->addArgument('shopId', InputArgument::OPTIONAL, 'Shop id', 1);
    }

    private function humanFilesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}
