<?php
/**
 * "Input" fixture of product EAV attribute.
 *
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/** @var \Magento\Eav\Model\Entity\Type $entityType */
$entityType = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create('Magento\Eav\Model\Entity\Type');
$entityType->loadByCode('catalog_product');
$defaultSetId = $entityType->getDefaultAttributeSetId();
/** @var \Magento\Eav\Model\Entity\Attribute\Set $defaultSet */
$defaultSet = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
    'Magento\Eav\Model\Entity\Attribute\Set'
);
$defaultSet->load($defaultSetId);
$defaultGroupId = $defaultSet->getDefaultGroupId();

/** @var $attribute \Magento\Catalog\Model\ResourceModel\Eav\Attribute */
$attribute = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
    'Magento\Catalog\Model\ResourceModel\Eav\Attribute'
);
$attribute->setAttributeCode(
    'unique_input_attribute'
)->setEntityTypeId(
    $entityType->getEntityTypeId()
)->setAttributeGroupId(
    $defaultGroupId
)->setAttributeSetId(
    $defaultSetId
)->setFrontendInput(
    'text'
)->setFrontendLabel(
    'Unique Input Attribute'
)->setBackendType(
    'varchar'
)->setIsUserDefined(
    1
)->setIsUnique(
    1
)->save();
