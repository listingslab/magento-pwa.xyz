<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Session;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Session\Config\ConfigInterface;
use Magento\Framework\Session\SaveHandler;
use Magento\Framework\App\ObjectManager;

class SaveHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var string Original session.save_handler ini config value */
    private $originalSaveHandler;

    public function setUp()
    {
        $this->originalSaveHandler = ini_get('session.save_handler');
    }

    /**
     * Tests that the session handler is correctly set when object is created.
     *
     * @dataProvider saveHandlerProvider
     * @param string $deploymentConfigHandler
     * @param string $iniHandler
     */
    public function testSetSaveHandler($deploymentConfigHandler, $iniHandler)
    {
        $this->markTestSkipped('MAGETWO-56529');
        // Set expected session.save_handler config
        if ($deploymentConfigHandler) {
            if ($deploymentConfigHandler !== 'files') {
                $expected = 'user';
            } else {
                $expected = $deploymentConfigHandler;
            }
        } else if ($iniHandler) {
            $expected = $iniHandler;
        } else {
            $expected = SaveHandlerInterface::DEFAULT_HANDLER;
        }

        // Set ini configuration
        if ($iniHandler) {
            ini_set('session.save_handler', $iniHandler);
        }

        /** @var DeploymentConfig | \PHPUnit_Framework_MockObject_MockObject $deploymentConfigMock */
        $deploymentConfigMock = $this->getMockBuilder(DeploymentConfig::class)
            ->disableOriginalConstructor()
            ->getMock();
        $deploymentConfigMock->expects($this->once())
            ->method('get')
            ->with(Config::PARAM_SESSION_SAVE_METHOD, SaveHandlerInterface::DEFAULT_HANDLER)
            ->willReturn($deploymentConfigHandler ?: SaveHandlerInterface::DEFAULT_HANDLER);

        new SaveHandler(
            ObjectManager::getInstance()->get(SaveHandlerFactory::class),
            $deploymentConfigMock
        );

        // Test expectation
        $this->assertEquals(
            $expected,
            ObjectManager::getInstance()->get(ConfigInterface::class)->getOption('session.save_handler')
        );
    }

    public function tearDown()
    {
        if (isset($this->originalSaveHandler)) {
            ini_set('session.save_handler', $this->originalSaveHandler);
        }
    }

    public function saveHandlerProvider()
    {
        return [
            ['db', false],
            ['db', 'files'],
            [false, 'files'],
            [false, false],
        ];
    }
}
