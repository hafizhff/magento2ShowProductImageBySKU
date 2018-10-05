<?php
/**
 * A Magento 2 module named Company/Module
 * Copyright (C) 2017 MrFizh
 * 
 * This file is part of Company/Module.
 * 
 * Company/Module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Company\Module\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_productFactory;
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_productFactory = $productFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
        // $product = $this->_productFactory->create()->loadByAttribute('sku', '24-MB01');
        // echo $product->getData('image');
        // echo $product->getData('thumbnail');
        // echo $product->getData('small_image');
    }
}
