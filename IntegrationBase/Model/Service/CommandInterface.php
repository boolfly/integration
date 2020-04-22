<?php
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationBase\Model\Service;

use Boolfly\IntegrationBase\Model\Service\Command\CommandException;

/**
 * Interface CommandInterface
 * @package Boolfly\IntegrationBase\Model\Service
 */
interface CommandInterface
{
    /**
     * @param array $subject
     * @return null| Command\ResultInterface
     * @throws CommandException
     */
    public function execute(array $subject);
}
