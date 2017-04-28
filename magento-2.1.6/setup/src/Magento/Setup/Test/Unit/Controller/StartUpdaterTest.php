<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Test\Unit\Controller;

use Magento\Setup\Model\Navigation;
use Magento\Setup\Controller\StartUpdater;

class StartUpdaterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StartUpdater|\PHPUnit_Framework_MockObject_MockObject
     */
    private $controller;

    /**
     * @var \Zend\Http\PhpEnvironment\Request|\PHPUnit_Framework_MockObject_MockObject
     */
    private $request;

    /**
     * @var \Zend\Http\PhpEnvironment\Response|\PHPUnit_Framework_MockObject_MockObject
     */
    private $response;

    /**
     * @var \Zend\Mvc\MvcEvent|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mvcEvent;

    /**
     * @var Magento\Setup\Model\PayloadValidator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $payloadValidator;

    /**
     * @var Magento\Setup\Model\UpdaterTaskCreator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $updaterTaskCreator;

    public function setUp()
    {
        $this->payloadValidator = $this->getMock('Magento\Setup\Model\PayloadValidator', [], [], '', false);
        $this->updaterTaskCreator = $this->getMock('Magento\Setup\Model\UpdaterTaskCreator', [], [], '', false);

        $this->controller = new StartUpdater(
            $this->updaterTaskCreator,
            $this->payloadValidator
        );
        $this->request = $this->getMock('\Zend\Http\PhpEnvironment\Request', [], [], '', false);
        $this->response = $this->getMock('\Zend\Http\PhpEnvironment\Response', [], [], '', false);
        $routeMatch = $this->getMock('\Zend\Mvc\Router\RouteMatch', [], [], '', false);
        $this->mvcEvent = $this->getMock('\Zend\Mvc\MvcEvent', [], [], '', false);
        $this->mvcEvent->expects($this->any())
            ->method('setRequest')
            ->with($this->request)
            ->willReturn($this->mvcEvent);
        $this->mvcEvent->expects($this->any())
            ->method('setResponse')
            ->with($this->response)
            ->willReturn($this->mvcEvent);
        $this->mvcEvent->expects($this->any())
            ->method('setTarget')
            ->with($this->controller)
            ->willReturn($this->mvcEvent);
        $this->mvcEvent->expects($this->any())->method('getRouteMatch')->willReturn($routeMatch);
    }
    
    public function testIndexAction()
    {
        $viewModel = $this->controller->indexAction();
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $viewModel);
        $this->assertTrue($viewModel->terminate());
    }

    /**
     * @param string $content
     * @param int $payload
     * @dataProvider updateInvalidRequestDataProvider
     */
    public function testUpdateInvalidRequest($content, $payload)
    {
        $this->request->expects($this->any())->method('getContent')->willReturn($content);
        $this->payloadValidator->expects($this->exactly($payload))->method('validatePayload');
        $this->controller->setEvent($this->mvcEvent);
        $this->controller->dispatch($this->request, $this->response);
        $this->controller->updateAction();
    }

    /**
     * @return array
     */
    public function updateInvalidRequestDataProvider()
    {
        return [
            'NoParmas' => ['{}', 0],
            'NoArray' => ['{"packages":"test","type":"update"}', 0],
            'NoVersion' => ['{"packages":[{"name":"vendor\/package"}],"type":"update"}', 1],
            'NoDataOption' => ['{"packages":[{"name":"vendor\/package", "version": "1.0.0"}],"type":"uninstall"}', 1],
            'NoPackageInfo' => ['{"packages":"test","type":"update"}', 0]
        ];
    }

    public function testUpdateActionSuccess()
    {
        $content = '{"packages":[{"name":"vendor\/package","version":"1.0"}],"type":"update",'
            . '"headerTitle": "Update package 1" }';
        $this->request->expects($this->any())->method('getContent')->willReturn($content);
        $this->payloadValidator->expects($this->once())->method('validatePayload')->willReturn('');
        $this->updaterTaskCreator->expects($this->once())->method('createUpdaterTasks')->willReturn('');
        $this->controller->setEvent($this->mvcEvent);
        $this->controller->dispatch($this->request, $this->response);
        $this->controller->updateAction();
    }
}
