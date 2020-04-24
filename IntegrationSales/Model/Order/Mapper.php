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

use Boolfly\IntegrationSales\Model\Sales;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\Order;
use Magento\Framework\Serialize\SerializerInterface;
use Boolfly\IntegrationBase\Model\Service\ConfigInterface;

class Mapper
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * Mapping constructor.
     * @param SerializerInterface $serializer
     * @param ConfigInterface $config
     */
    public function __construct(
        SerializerInterface $serializer,
        ConfigInterface $config
    ) {
        $this->serializer = $serializer;
        $this->config = $config;
    }

    /**
     * @param Order $order
     * @return array
     * @throws LocalizedException
     */
    public function map($order)
    {
        $data = [];
        try {
            $mappingData = $this->config->getValue('mapping_fields');
            $fields = is_array($mappingData) ? $mappingData : $this->serializer->unserialize($mappingData);
            if (empty($fields)) {
                throw new LocalizedException(
                    __('There is no mapping field.')
                );
            }
            foreach ($fields as $field) {
                $data[$field['external_order']] = $order->getData($field['magento_order']);
            }
        } catch (\Exception $exception) {
            throw new LocalizedException(
                __($exception->getMessage())
            );
        }
        return [
            'entity_type' => Sales::ORDER_ENTITY,
            'entity_id' => $order->getIncrementId(),
            'data' => $this->serializer->serialize($data)
        ];
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config->isSetFlag('enable');
    }
}
