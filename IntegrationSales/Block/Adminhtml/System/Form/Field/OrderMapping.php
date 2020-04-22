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

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class OrderMapping extends AbstractFieldArray
{
    /**
     * @var Order
     */
    private $orderRenderer;

    /**
     * @inheritdoc
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            'external_order',
            [
                'label' => __('External Order Fields'),
                'class' => 'input-text required-entry validate-no-empty'
            ]
        );
        $this->addColumn(
            'magento_order',
            [
                'label' => __('Magento Order fields'),
                'renderer' => $this->getOrderFieldsRenderer(),
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * @inheritdoc
     */
    protected function _prepareArrayRow(DataObject $row)
    {
        $optionExtraAttr = [];
        $optionExtraAttr['option_' . $this->getOrderFieldsRenderer()->calcOptionHash($row->getData('magento_order'))] =
            'selected="selected"';
        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
        );
    }

    /**
     * Retrieve order fields renderer
     * @throws LocalizedException
     */
    private function getOrderFieldsRenderer()
    {
        if (!$this->orderRenderer) {
            $this->orderRenderer = $this->getLayout()->createBlock(
                Order::class,
                '',
                [
                    'data' => [
                        'is_render_to_js_template' => true,
                        'class' => 'input-text required-entry validate-no-empty',
                    ],
                ]
            );
        }

        return $this->orderRenderer;
    }
}
