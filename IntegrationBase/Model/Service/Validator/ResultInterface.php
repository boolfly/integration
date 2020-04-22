<?php
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationBase\Model\Service\Validator;

use Magento\Framework\Phrase;

/**
 * Interface ResultInterface
 * @package Boolfly\IntegrationBase\Model\Service\Validator
 */
interface ResultInterface
{
    /**
     * Returns validation result
     *
     * @return bool
     */
    public function isValid();

    /**
     * Returns list of fails description
     *
     * @return Phrase[]
     */
    public function getFailsDescription();

    /**
     * Returns list of error codes.
     *
     * @return string[]
     */
    public function getErrorCodes();
}
