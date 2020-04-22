<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Order\Config\Source;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\OptionSourceInterface;

class Order implements OptionSourceInterface
{
    const ORDER_TABLE = 'sales_order';

    /** @var array */
    private $options;

    /**
     * @var ResourceConnection
     */
    protected $resource;

    /**
     * Order constructor.
     * @param ResourceConnection $resource
     */
    public function __construct(
        ResourceConnection $resource
    ) {
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            $columns = [];
            $tableColumns = $this->resource->getConnection()->describeTable(self::ORDER_TABLE);
            foreach (array_keys($tableColumns) as $col) {
                $label = str_replace('_', ' ', $col);
                $columns[] = ['value' => $col, 'label' => $label];
            }
            $this->options = $columns;
            array_unshift($this->options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $this->options;
    }
}
