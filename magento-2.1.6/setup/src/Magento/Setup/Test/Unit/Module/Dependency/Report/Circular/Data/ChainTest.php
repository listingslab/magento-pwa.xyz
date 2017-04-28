<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Test\Unit\Module\Dependency\Report\Circular\Data;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class ChainTest extends \PHPUnit_Framework_TestCase
{
    public function testGetModules()
    {
        $modules = ['foo', 'baz', 'bar'];

        $objectManagerHelper = new ObjectManager($this);
        /** @var \Magento\Setup\Module\Dependency\Report\Circular\Data\Chain $chain */
        $chain = $objectManagerHelper->getObject(
            'Magento\Setup\Module\Dependency\Report\Circular\Data\Chain',
            ['modules' => $modules]
        );

        $this->assertEquals($modules, $chain->getModules());
    }
}
