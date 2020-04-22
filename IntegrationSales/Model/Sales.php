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

use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class Sales
 * @method string getEntityType()
 * @package Boolfly\IntegrationSales\Model
 */
class Sales extends AbstractExtensibleModel
{
    const ORDER_ENTITY = 'order';

    const STATUS_PENDING = 'pending';

    const STATUS_RUNNING = 'running';

    const STATUS_SUCCESS = 'success';

    const STATUS_ERROR = 'error';

    protected function _construct()
    {
        $this->_init(ResourceModel\Sales::class);
    }
}
