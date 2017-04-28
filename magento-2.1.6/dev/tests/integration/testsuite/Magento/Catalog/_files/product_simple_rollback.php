<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
use Magento\Framework\Exception\NoSuchEntityException;

\Magento\TestFramework\Helper\Bootstrap::getInstance()->getInstance()->reinitialize();

/** @var \Magento\Framework\Registry $registry */
$registry = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->get('Magento\Framework\Registry');

$registry->unregister('isSecureArea');
$registry->register('isSecureArea', true);

/** @var \Magento\Catalog\Api\ProductRepositoryInterface $productRepository */
$productRepository = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->get('Magento\Catalog\Api\ProductRepositoryInterface');
try {
    $product = $productRepository->get('simple', false, null, true);
    $productRepository->delete($product);
} catch (NoSuchEntityException $e) {

}
$registry->unregister('isSecureArea');
$registry->register('isSecureArea', false);
