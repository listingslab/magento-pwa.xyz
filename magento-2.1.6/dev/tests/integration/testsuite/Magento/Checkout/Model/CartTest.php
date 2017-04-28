<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Checkout\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\TestFramework\Helper\Bootstrap;

class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    protected function setUp()
    {
        $this->cart = Bootstrap::getObjectManager()->create(Cart::class);
        $this->productRepository = Bootstrap::getObjectManager()->create(ProductRepositoryInterface::class);
    }

    /**
     * @magentoDataFixture Magento/Checkout/_files/simple_product.php
     * @magentoDataFixture Magento/Checkout/_files/set_product_min_in_cart.php
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     */
    public function testAddProductWithLowerQty()
    {
        $this->setExpectedException(
            \Magento\Framework\Exception\LocalizedException::class,
            'The fewest you may purchase is 3'
        );
        $product = $this->productRepository->get('simple');
        $this->cart->addProduct($product->getId(), ['qty' => 1]);
    }

    /**
     * @magentoDataFixture Magento/Checkout/_files/simple_product.php
     * @magentoDataFixture Magento/Checkout/_files/set_product_min_in_cart.php
     * @magentoDbIsolation enabled
     */
    public function testAddProductWithNoQty()
    {
        $product = $this->productRepository->get('simple');
        $this->cart->addProduct($product->getId(), []);
    }
}
