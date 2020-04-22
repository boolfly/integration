<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Service\Request;

use Boolfly\IntegrationBase\Model\Service\Request\BuilderInterface;

class Builder implements BuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        $result = [];
        $result['data'] = $buildSubject['data'];
        return $result;
    }
}
