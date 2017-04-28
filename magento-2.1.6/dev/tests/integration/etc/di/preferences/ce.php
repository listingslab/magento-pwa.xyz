<?php
/**
 * Preferences for classes like in di.xml (for integration tests)
 *
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

return [
    'Magento\Framework\Stdlib\CookieManagerInterface' => 'Magento\TestFramework\CookieManager',
    'Magento\Framework\ObjectManager\DynamicConfigInterface' =>
        '\Magento\TestFramework\ObjectManager\Configurator',
    'Magento\Framework\App\RequestInterface' => 'Magento\TestFramework\Request',
    'Magento\Framework\App\Request\Http' => 'Magento\TestFramework\Request',
    'Magento\Framework\App\ResponseInterface' => 'Magento\TestFramework\Response',
    'Magento\Framework\App\Response\Http' => 'Magento\TestFramework\Response',
    'Magento\Framework\Interception\PluginListInterface' =>
        'Magento\TestFramework\Interception\PluginList',
    'Magento\Framework\Interception\ObjectManager\Config\Developer' =>
        'Magento\TestFramework\ObjectManager\Config',
    'Magento\Framework\View\LayoutInterface' => 'Magento\TestFramework\View\Layout',
    'Magento\Framework\App\ResourceConnection\ConnectionAdapterInterface' =>
        'Magento\TestFramework\Db\ConnectionAdapter',
    'Magento\Framework\Filesystem\DriverInterface' => 'Magento\Framework\Filesystem\Driver\File',
    \Magento\Framework\App\Config\ScopeConfigInterface::class => \Magento\TestFramework\App\Config::class,
];
