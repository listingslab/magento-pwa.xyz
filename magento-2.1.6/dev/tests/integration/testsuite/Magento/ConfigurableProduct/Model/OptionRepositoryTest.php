<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\ConfigurableProduct\Model;

class OptionRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @magentoDataFixture Magento/ConfigurableProduct/_files/product_configurable.php
     */
    public function testGetListWithExtensionAttributes()
    {
        $this->markTestSkipped('Test skipped due to MAGETWO-45654');
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $productSku = 'configurable';
        /** @var \Magento\ConfigurableProduct\Api\OptionRepositoryInterface $optionRepository */
        $optionRepository = $objectManager->create('Magento\ConfigurableProduct\Api\OptionRepositoryInterface');

        $options = $optionRepository->getList($productSku);
        $this->assertCount(1, $options, "Invalid number of option.");
        $this->assertNotNull($options[0]->getExtensionAttributes(), "Extension attributes not loaded");
        /** @var \Magento\Eav\Model\Entity\Attribute $joinedEntity */
        $joinedEntity = $objectManager->create('Magento\Eav\Model\Entity\Attribute');
        $joinedEntity->load($options[0]->getId());
        $joinedExtensionAttributeValue = $joinedEntity->getAttributeCode();
        $this->assertEquals(
            $joinedExtensionAttributeValue,
            $options[0]->getExtensionAttributes()->getTestDummyAttribute(),
            "Extension attributes were not loaded correctly"
        );
    }
}
