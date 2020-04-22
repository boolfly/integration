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
 * Interface ConverterInterface
 * @package Boolfly\IntegrationBase\Model\Service\Http
 */
interface ConverterInterface
{
    /**
     * Converts response to ENV structure
     *
     * @param mixed $response
     * @return array
     * @throws \Boolfly\IntegrationBase\Model\Service\Http\ConverterException
     */
    public function convert($response);
}
