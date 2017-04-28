<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Image\Adapter;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAdapterName()
    {
        /** @var Config $config */
        $config = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
            ->create('Magento\Framework\Image\Adapter\Config');
        $this->assertEquals(\Magento\Framework\Image\Adapter\AdapterInterface::ADAPTER_GD2, $config->getAdapterAlias());
    }
}
