<?php declare(strict_types=1);
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   Boolfly Integration
 */
namespace Boolfly\IntegrationBase\Model\Service;

/**
 * Class SubjectReader
 * @package Boolfly\IntegrationBase\Model\Service
 */
class SubjectReader
{
    /**
     * Reads response object from subject
     *
     * @param array $subject
     * @return object
     */
    public function readResponseObject(array $subject)
    {
        $response = $this->readResponse($subject);
        if (!isset($response['object']) || !is_object($response['object'])) {
            throw new \InvalidArgumentException('Response object does not exist');
        }

        return $response['object'];
    }

    /**
     * Reads response NVP from subject
     *
     * @param array $subject
     * @return array
     */
    public static function readResponse(array $subject)
    {
        if (!isset($subject['response']) || !is_array($subject['response'])) {
            throw new \InvalidArgumentException('Response does not exist');
        }

        return $subject['response'];
    }
}
