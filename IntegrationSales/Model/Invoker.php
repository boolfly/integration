<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model;

use Boolfly\IntegrationBase\Model\Service\Command\CommandPoolInterface;
use Boolfly\IntegrationBase\Model\Service\ConfigInterface;
use Boolfly\IntegrationBase\Model\Service\InvokerInterface;
use Boolfly\IntegrationSales\Model\ResourceModel\Sales\Collection;
use Boolfly\IntegrationSales\Model\ResourceModel\Sales\CollectionFactory;

class Invoker implements InvokerInterface
{
    const BATCH_SIZE = 200;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CommandPoolInterface
     */
    private $commandPool;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var string
     */
    private $code;

    /**
     * Invoker constructor.
     * @param CollectionFactory $collectionFactory
     * @param CommandPoolInterface $commandPool
     * @param ConfigInterface $config
     * @param $code
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        CommandPoolInterface $commandPool,
        ConfigInterface $config,
        $code = null
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->commandPool = $commandPool;
        $this->config = $config;
        $this->code = $code;
    }

    /**
     * @inheritDoc
     */
    public function run(): void
    {
        if (!$this->canPerformCommand()) {
            return;
        };
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('status', ['eq' => Sales::STATUS_PENDING]);
        $collection->addFieldToFilter('entity_type', ['eq' => $this->code]);
        $collection->setPageSize(self::BATCH_SIZE);
        $totalsPage = $collection->getLastPageNumber();
        $currentPage = 1;
        $i = 1;
        if ($collection->getSize() > 0) {
            do {
                $collection->setCurPage($currentPage);
                foreach ($collection->getItems() as $item) {
                    /** @var Sales $item */
                    /** @TODO try catch exception */
                    $this->commandPool->get($this->code)->execute($item->getData());
                    $i++;
                };
                $currentPage++;
                $collection->clear();
            } while ($currentPage <= $totalsPage);
        }
    }

    /**
     * @return bool
     */
    public function canPerformCommand(): bool
    {
        if ($this->code) {
            return $this->config->isSetFlag('enable');
        }
        return false;
    }
}
