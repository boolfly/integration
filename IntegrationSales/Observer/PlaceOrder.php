<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Observer;

use Boolfly\IntegrationSales\Model\Order\Mapping;
use Boolfly\IntegrationSales\Model\Sales;
use Boolfly\IntegrationSales\Model\SalesFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;

class PlaceOrder implements ObserverInterface
{
    /**
     * @var SalesFactory
     */
    private $salesFactory;

    /**
     * @var Mapping
     */
    private $mapping;

    /**
     * PlaceOrder constructor.
     * @param SalesFactory $salesFactory
     * @param Mapping $mapping
     */
    public function __construct(
        SalesFactory $salesFactory,
        Mapping $mapping
    ) {
        $this->salesFactory = $salesFactory;
        $this->mapping = $mapping;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        if ($this->mapping->isEnabled()) {
            /** @var Order $order */
            $order = $observer->getEvent()->getData('order');
            /** @var Sales $salesOrder */
            $salesOrder = $this->salesFactory->create();
            /*
             * We can add our custom mapping logic
             */
            $data  = $this->mapping->map($order);
            $salesOrder->addData($data);
            $salesOrder->save();
        }
    }
}
