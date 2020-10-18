<?php

namespace App\Command;

use App\Helper\priceAlertHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PriceAlertCommand extends Command
{
    protected static $defaultName = 'app:price-alert';
    /**
     * @var priceAlertHelper
     */
    private $priceAlertHelper;

    public function __construct(priceAlertHelper $priceAlertHelper)
    {
        $this->priceAlertHelper = $priceAlertHelper;
        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        $this
            ->setDescription('Get price alert')
            ->addOption('url', null, InputOption::VALUE_REQUIRED)
            ->addOption('threshold', null, InputOption::VALUE_REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getOption('url');
        $threshold = (int) $input->getOption('threshold');
        $this->priceAlertHelper->priceLookup($url, $threshold);

        return Command::SUCCESS;
    }
}

