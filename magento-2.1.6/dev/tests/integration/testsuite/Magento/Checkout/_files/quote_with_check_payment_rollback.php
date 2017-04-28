<?php
/**
 * Rollback for quote_with_check_payment.php fixture.
 *
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
require __DIR__ . '/../../Sales/_files/default_rollback.php';

/** @var $objectManager \Magento\TestFramework\ObjectManager */
$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
$objectManager->get('Magento\Framework\Registry')->unregister('quote');
$quote = $objectManager->create('Magento\Quote\Model\Quote');
$quote->load('test_order_1', 'reserved_order_id')->delete();
