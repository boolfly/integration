<?php
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationBase\Model\Service\Http;

/**
 * Interface ClientInterface
 * @package Boolfly\IntegrationBase\Model\Service\Http
 */
interface ClientInterface
{
    /**
     * Making request. Returns result as ENV array
     *
     * @param \Boolfly\IntegrationBase\Model\Service\Http\TransferInterface $transferObject
     * @return array
     * @throws \Boolfly\IntegrationBase\Model\Service\Http\ClientException
     * @throws \Boolfly\IntegrationBase\Model\Service\Http\ConverterException
     */
    public function request(\Boolfly\IntegrationBase\Model\Service\Http\TransferInterface $transferObject);
}
