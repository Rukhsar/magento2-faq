<?php

namespace Rukhsar\Faq\Controller\Adminhtml\Groups;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Rukhsar\Faq\Controller\Adminhtml\Groups
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var
     */
    protected $resultPage;

    /**
     * Index constructor.
     *
     * @param \Magento\Backend\App\Action\Context        $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Rukhsar_Faq::groups');
        $resultPage->getConfig()->getTitle()->prepend((__('Groups')));
        $resultPage->addBreadcrumb(__('FAQ'), __('FAQ'));

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Rukhsar_Faq::groups');
    }
}
