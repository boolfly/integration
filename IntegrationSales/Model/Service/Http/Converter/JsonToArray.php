<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Service\Http\Converter;

use Magento\Framework\Serialize\Serializer\Json;
use Boolfly\IntegrationBase\Model\Service\Http\ConverterException;
use Boolfly\IntegrationBase\Model\Service\Http\ConverterInterface;
use Psr\Log\LoggerInterface;

/**
 * Class JsonToArray
 *
 * @package Boolfly\IntegrationSales\Gateway\Http\Converter
 */
class JsonToArray implements ConverterInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Json
     */
    private $serializer;

    /**
     * JsonToArray constructor.
     *
     * @param Json            $serializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        Json $serializer,
        LoggerInterface $logger
    ) {
        $this->logger     = $logger;
        $this->serializer = $serializer;
    }

    /**
     * Converts gateway response to array structure
     *
     * @param mixed $response
     * @return array
     * @throws ConverterException
     */
    public function convert($response)
    {
        try {
            return $this->serializer->unserialize($response);
        } catch (\Exception $e) {
            $this->logger->critical('Can\'t read response from Order Integration');
            throw new ConverterException(__('Can\'t read response from Order Integration'));
        }
    }
}
