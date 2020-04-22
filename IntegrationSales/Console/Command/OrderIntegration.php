<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Console\Command;

use Boolfly\IntegrationSales\Model\Order\Invoker;
use Exception;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Framework\Console\Cli;
use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderIntegration extends Command
{
    /**
     * @var Invoker
     */
    private $invoker;

    /**
     * @var State
     */
    private $state;

    /**
     * OrderIntegration constructor.
     * @param Invoker $invoker
     * @param State $state
     * @param null $name
     */
    public function __construct(
        Invoker $invoker,
        State $state,
        $name = null
    ) {
        $this->invoker = $invoker;
        $this->state = $state;
        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('bf_integration:order:update');
        $this->setDescription('Boolfly order integration.');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws LocalizedException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        $output->writeln('<info>Starting integration...</info>');
        try {
            $this->invoker->run();
        } catch (Exception $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</error>');
            return Cli::RETURN_FAILURE;
        }
        $output->writeln('<info>Integrated successfully.</info>');
        return Cli::RETURN_SUCCESS;
    }
}
