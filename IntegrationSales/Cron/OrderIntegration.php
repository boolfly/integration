<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Cron;

use Boolfly\IntegrationSales\Model\Order\Invoker;

class OrderIntegration
{
    /**
     * @var Invoker
     */
    private $invoker;

    /**
     * OrderIntegration constructor.
     * @param Invoker $invoker
     */
    public function __construct(
        Invoker $invoker
    ) {
        $this->invoker = $invoker;
    }

    public function execute()
    {
        $this->invoker->run();
    }
}
