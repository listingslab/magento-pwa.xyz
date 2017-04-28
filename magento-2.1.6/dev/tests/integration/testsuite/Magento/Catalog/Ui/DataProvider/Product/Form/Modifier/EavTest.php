<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Ui\DataProvider\Product\Form\Modifier;

/**
 * @magentoDbIsolation enabled
 * @magentoAppIsolation enabled
 * @magentoAppArea adminhtml
 */
class EavTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav
     */
    protected $eavModifier;

    /**
     * @var \Magento\Catalog\Model\Locator\LocatorInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $locatorMock;

    protected function setUp()
    {
        $mappings = [
            "text" => "input",
            "hidden" => "input",
            "boolean" => "checkbox",
            "media_image" => "image",
            "price" => "input",
            "weight" => "input",
            "gallery" => "image"
        ];
        $this->objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $this->locatorMock = $this->getMock(\Magento\Catalog\Model\Locator\LocatorInterface::class, [], [], "", false);
        $store = $this->objectManager->get(\Magento\Store\Api\Data\StoreInterface::class);
        $this->locatorMock->expects($this->any())->method('getStore')->willReturn($store);
        $this->eavModifier = $this->objectManager->create(
            \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav::class,
            [
                'locator' => $this->locatorMock,
                'formElementMapper' => $this->objectManager->create(
                    \Magento\Ui\DataProvider\Mapper\FormElement::class,
                    ['mappings' => $mappings]
                )
            ]
        );
        parent::setUp();
    }

    /**
     * @magentoDataFixture Magento/Catalog/_files/product_simple.php
     */
    public function testModifyMeta()
    {
        $this->objectManager->get(\Magento\Eav\Model\Entity\AttributeCache::class)->clear();
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->objectManager->create(\Magento\Catalog\Model\Product::class);
        $product->load(1);
        $this->locatorMock->expects($this->any())->method('getProduct')->willReturn($product);
        $expectedMeta = include __DIR__ . '/_files/eav_expected_meta_output.php';
        $actualMeta = $this->eavModifier->modifyMeta([]);
        $this->prepareDataForComparison($actualMeta, $expectedMeta);
        $this->assertEquals($expectedMeta, $actualMeta);
    }

    /**
     * @magentoDataFixture Magento/Catalog/_files/product_simple_with_admin_store.php
     */
    public function testModifyData()
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->objectManager->create(\Magento\Catalog\Model\Product::class);
        $product->load(1);
        $this->locatorMock->expects($this->any())->method('getProduct')->willReturn($product);
        $expectedData = include __DIR__ . '/_files/eav_expected_data_output.php';
        $actualData = $this->eavModifier->modifyData([]);
        $this->prepareDataForComparison($actualData, $expectedData);
        $this->assertEquals($expectedData, $actualData);
    }

    /**
     * Prepare data for comparison to avoid false positive failures.
     *
     * Make sure that $data contains all the data contained in $expectedData,
     * ignore all fields not declared in $expectedData
     *
     * @param array &$data
     * @param array $expectedData
     * @return void
     */
    private function prepareDataForComparison(array &$data, array $expectedData)
    {
        foreach ($data as $key => &$item) {
            if (!isset($expectedData[$key])) {
                unset($data[$key]);
                continue;
            }
            if ($item instanceof \Magento\Framework\Phrase) {
                $item = (string)$item;
            } else if (is_array($item)) {
                $this->prepareDataForComparison($item, $expectedData[$key]);
            } else if ($key === 'price_id' || $key === 'sortOrder') {
                $data[$key] = '__placeholder__';
            }
        }
    }
}
