<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Block\Adminhtml\System\Form\Field;

use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;
use Boolfly\IntegrationSales\Model\Order\Config\Source\Order as OrderSource;

class Order extends Select
{
    /**
     * @var OrderSource
     */
    private $order;

    /**
     * Order constructor.
     * @param Context $context
     * @param OrderSource $order
     * @param array $data
     */
    public function __construct(
        Context $context,
        OrderSource $order,
        array $data = []
    ) {
        $this->order = $order;
        parent::__construct($context, $data);
    }

    /**
     * Get order options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->order->toOptionArray();
    }

    /**
     * Sets name for input element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setData('name', $value);
    }
}
