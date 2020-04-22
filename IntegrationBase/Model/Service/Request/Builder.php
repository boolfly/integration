<?php declare(strict_types=1);

namespace Boolfly\IntegrationBase\Model\Service\Request;

/**
 * Class BuilderComposite
 * @package Boolfly\IntegrationBase\Model\Service\Request
 */
class Builder implements BuilderInterface
{
    /**
     * Builds ENV request
     *
     * @param $buildSubject
     * @return array
     */
    public function build($buildSubject)
    {
        $result = [];
        return $result;
    }
}
