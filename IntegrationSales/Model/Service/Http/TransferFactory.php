<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Service\Http;

use Boolfly\IntegrationBase\Model\Service\Http\TransferFactoryInterface;
use Boolfly\IntegrationBase\Model\Service\Http\TransferInterface;
use Boolfly\IntegrationBase\Model\Service\Http\TransferBuilder;
use Boolfly\IntegrationSales\Model\Service\Helper\Authorization;

class TransferFactory implements TransferFactoryInterface
{
    /**
     * @var TransferBuilder
     */
    private $transferBuilder;

    /**
     * @var Authorization
     */
    private $authorization;

    /**
     * @param Authorization $authorization
     * @param TransferBuilder $transferBuilder
     */
    public function __construct(
        Authorization $authorization,
        TransferBuilder $transferBuilder
    ) {
        $this->authorization = $authorization;
        $this->transferBuilder = $transferBuilder;
    }

    /**
     * Builds service transfer object
     *
     * @param array $request
     * @return TransferInterface
     */
    public function create(array $request)
    {
        $header = $this->getAuthorization()
            ->setParameter($request)
            ->getHeaders();
        $body = $this->getAuthorization()->getBody($request);
        return $this->transferBuilder
            ->setMethod('POST')
            ->setHeaders($header)
            ->setBody($body)
            ->setUri($this->getAuthorization()->getUrlPath())
            ->build();
    }

    /**
     * @return Authorization
     */
    protected function getAuthorization()
    {
        return $this->authorization;
    }
}
