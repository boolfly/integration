<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationSales\Model\Service\Helper;

use Boolfly\IntegrationBase\Model\Service\ConfigInterface;
use Magento\Framework\Serialize\SerializerInterface;

class Authorization
{
    /**
     * @var string
     */
    protected $params;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * Authorization constructor.
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
     * @return string
     */
    public function getParameter()
    {
        return $this->params;
    }

    /**
     * @param $params
     * @return $this
     */
    public function setParameter($params)
    {
        $this->params = $this->serializer->serialize($params);
        return $this;
    }

    /**
     * @param $params
     * @return bool|string
     */
    public function getBody($params)
    {
        return $this->serializer->serialize($params['data']);
    }

    /**
     * Get Header
     *
     * @return array
     */
    public function getHeaders()
    {
        return [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($this->getParameter())
        ];
    }

    /**
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->config->getValue('username');
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->config->getValue('password');
    }

    /**
     * @return string
     */
    public function getUrlPath()
    {
        return $this->config->getValue('external_url');
    }
}
