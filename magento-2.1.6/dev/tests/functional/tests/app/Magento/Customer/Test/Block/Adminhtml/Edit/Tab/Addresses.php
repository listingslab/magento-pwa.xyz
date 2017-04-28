<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Customer\Test\Block\Adminhtml\Edit\Tab;

use Magento\Backend\Test\Block\Widget\Tab;
use Magento\Mtf\Block\BlockFactory;
use Magento\Mtf\Client\Element\SimpleElement;
use Magento\Mtf\Client\Element;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\FixtureInterface;
use Magento\Mtf\ObjectManager;
use Magento\Mtf\Util\ModuleResolver\SequenceSorterInterface;
use Magento\Mtf\Client\BrowserInterface;
use Magento\Mtf\Block\Mapper;
use Magento\Customer\Test\Fixture\Address;

/**
 * Customer addresses edit block.
 */
class Addresses extends Tab
{
    /**
     * "Add New Customer" button.
     *
     * @var string
     */
    protected $addNewAddress = '.address-list-actions .add';

    /**
     * Selector for address block.
     *
     * @var string
     */
    protected $addressSelector = "//li[address[contains(.,'%s')]]";

    /**
     * Delete Address button.
     *
     * @var string
     */
    protected $deleteAddress = '.action-delete';

    /**
     * Accept button selector.
     *
     * @var string
     */
    private $confirmModal = '.confirm._show[data-role=modal]';

    /**
     * Open customer address.
     *
     * @var string
     */
    protected $customerAddress = '//*[contains(@class, "address-list-item")][%d]';

    /**
     * Magento loader.
     *
     * @var string
     */
    protected $loader = '//ancestor::body/div[@data-role="loader"]';

    /**
     * Object Manager.
     *
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @constructor
     * @param SimpleElement $element
     * @param BlockFactory $blockFactory
     * @param Mapper $mapper
     * @param BrowserInterface $browser
     * @param SequenceSorterInterface $sequenceSorter
     * @param ObjectManager $objectManager
     * @param array $config [optional]
     */
    public function __construct(
        SimpleElement $element,
        BlockFactory $blockFactory,
        Mapper $mapper,
        BrowserInterface $browser,
        SequenceSorterInterface $sequenceSorter,
        ObjectManager $objectManager,
        array $config = []
    ) {
        $this->objectManager = $objectManager;
        parent::__construct($element, $blockFactory, $mapper, $browser, $sequenceSorter, $config);
    }

    /**
     * Fill customer addresses.
     *
     * @param FixtureInterface|FixtureInterface[] $address
     * @return $this
     */
    public function fillAddresses($address)
    {
        $addresses = is_array($address) ? $address : [$address];
        foreach ($addresses as $address) {
            $this->addNewAddress();
            $this->setFieldsData($address->getData(), $this->_rootElement);
        }

        return $this;
    }

    /**
     * Update customer addresses.
     *
     * @param FixtureInterface|FixtureInterface[] $address
     * @return $this
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function updateAddresses($address)
    {
        $addresses = is_array($address) ? $address : [1 => $address];
        foreach ($addresses as $addressNumber => $address) {
            /* Throw exception if isn't exist previous customer address. */
            if (1 < $addressNumber && !$this->isVisibleCustomerAddress($addressNumber - 1)) {
                throw new \Exception("Invalid argument: can't update customer address #{$addressNumber}");
            }

            if (!$this->isVisibleCustomerAddress($addressNumber)) {
                $this->addNewAddress();
            }
            $this->openCustomerAddress($addressNumber);

            $defaultAddress = ['default_billing' => 'No', 'default_shipping' => 'No'];
            $addressData = $address->getData();
            foreach ($defaultAddress as $key => $value) {
                if (isset($addressData[$key])) {
                    $defaultAddress[$key] = $value;
                }
            }
            $this->_fill($this->dataMapping($defaultAddress));

            $this->setFieldsData(array_diff($addressData, $defaultAddress), $this->_rootElement);
        }

        return $this;
    }

    /**
     * Get data from Customer addresses.
     *
     * @param FixtureInterface|FixtureInterface[]|null $address
     * @return array
     * @throws \Exception
     */
    public function getDataAddresses($address = null)
    {
        $data = [];
        $addresses = is_array($address) ? $address : [1 => $address];

        foreach ($addresses as $addressNumber => $address) {
            $isHasData = (null === $address) || $address->hasData();
            $isVisibleCustomerAddress = $this->isVisibleCustomerAddress($addressNumber);

            if ($isHasData && !$isVisibleCustomerAddress) {
                throw new \Exception("Invalid argument: can't get data from customer address #{$addressNumber}");
            }

            if (!$isHasData && !$isVisibleCustomerAddress) {
                $data[$addressNumber] = [];
            } else {
                $this->openCustomerAddress($addressNumber);
                $data[$addressNumber] = $this->getData($address, $this->_rootElement);
            }
        }

        return $data;
    }

    /**
     * Get data to fields on tab.
     *
     * @param array|null $fields
     * @param SimpleElement|null $element
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getFieldsData($fields = null, SimpleElement $element = null)
    {
        /* Skip get data for standard method. Use getDataAddresses. */
        return [];
    }

    /**
     * Click "Add New Address" button.
     */
    protected function addNewAddress()
    {
        $this->_rootElement->find($this->addNewAddress)->click();
    }

    /**
     * Open customer address.
     *
     * @param int $addressNumber
     * @throws \Exception
     */
    protected function openCustomerAddress($addressNumber)
    {
        $addressTab = $this->_rootElement->find(
            sprintf($this->customerAddress, $addressNumber),
            Locator::SELECTOR_XPATH
        );

        if (!$addressTab->isVisible()) {
            throw new \Exception("Can't open customer address #{$addressNumber}");
        }
        $addressTab->click();
    }

    /**
     * Check is visible customer address.
     *
     * @param int $addressNumber
     * @return bool
     */
    protected function isVisibleCustomerAddress($addressNumber)
    {
        $addressTab = $this->_rootElement->find(
            sprintf($this->customerAddress, $addressNumber),
            Locator::SELECTOR_XPATH
        );

        return $addressTab->isVisible();
    }

    /**
     * Click delete customer address button.
     *
     * @param Address $addressToDelete
     * @return $this
     */
    public function deleteCustomerAddress(Address $addressToDelete)
    {
        $addressRenderer = $this->objectManager->create(
            \Magento\Customer\Test\Block\Address\Renderer::class,
            ['address' => $addressToDelete, 'type' => 'html']
        );
        $addressToDelete = $addressRenderer->render();

        $dataList = explode("\n", $addressToDelete);
        $dataList = implode("') and contains(.,'", $dataList);

        $this->_rootElement
            ->find(sprintf($this->addressSelector, $dataList), Locator::SELECTOR_XPATH)
            ->find($this->deleteAddress)->click();

        $element = $this->browser->find($this->confirmModal);
        /** @var \Magento\Ui\Test\Block\Adminhtml\Modal $modal */
        $modal = $this->blockFactory->create(\Magento\Ui\Test\Block\Adminhtml\Modal::class, ['element' => $element]);
        $modal->acceptAlert();

        return $this;
    }
}
