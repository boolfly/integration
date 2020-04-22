<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Service\Response;

use Boolfly\IntegrationBase\Model\Service\Response\HandlerInterface;
use Boolfly\IntegrationSales\Model\Sales;
use Boolfly\IntegrationSales\Model\SalesFactory;

class StatusHandler implements HandlerInterface
{
    /**
     * @var SalesFactory
     */
    private $salesFactory;

    /**
     * StatusHandler constructor.
     * @param SalesFactory $salesFactory
     */
    public function __construct(
        SalesFactory $salesFactory
    ) {
        $this->salesFactory = $salesFactory;
    }

    /**
     * Update status
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        if (isset($handlingSubject['id'])) {
            /** @var Sales $sales */
            $sales = $this->salesFactory->create()->load($handlingSubject['id']);
            if (!empty($response)) {
                $sales->setStatus(Sales::STATUS_SUCCESS);
            } else {
                $sales->setStatus(Sales::STATUS_ERROR);
            }
            $sales->save();
        }
    }
}
