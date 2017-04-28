<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Block\Product\ProductList;

use Magento\Mtf\Block\Block;

/**
 * Class TopToolbar
 * Top toolbar the product list page
 */
class TopToolbar extends Block
{
    /**
     * Selector for "sort by" element
     *
     * @var string
     */
    protected $sorter = '#sorter';

    /**
     * Get method of sorting product
     *
     * @return array|string
     */
    public function getSelectSortType()
    {
        return $this->_rootElement->find("#sorter")->getElements('option[selected]')[0]->getText();
    }

    /**
     * Get all available method of sorting product
     *
     * @return array|string
     */
    public function getSortType()
    {
        $content = str_replace("\r", '', $this->_rootElement->find($this->sorter)->getText());
        return explode("\n", $content);
    }
}
