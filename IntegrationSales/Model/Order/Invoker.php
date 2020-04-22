<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Order;

use Boolfly\IntegrationBase\Model\Service\InvokerInterface;

class Invoker implements InvokerInterface
{
    /**
     * @var InvokerInterface
     */
    private $invoker;

    /**
     * Invoker constructor.
     * @param InvokerInterface $invoker
     */
    public function __construct(
        InvokerInterface $invoker
    ) {
        $this->invoker = $invoker;
    }

    /**
     * @inheritDoc
     */
    public function run(): void
    {
        $this->invoker->run();
    }
}
