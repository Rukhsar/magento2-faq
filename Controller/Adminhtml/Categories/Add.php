<?php

namespace Rukhsar\Faq\Controller\Adminhtml\Categories;

use \Magento\Backend\App\Action;

/**
 * Class Add
 *
 * @package Rukhsar\Faq\Controller\Adminhtml\Categories
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Add extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
