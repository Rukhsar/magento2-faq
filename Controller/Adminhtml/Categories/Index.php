<?php

namespace Rukhsar\Faq\Controller\Adminhtml\Categories;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    protected $resultPage;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Rukhsar_Faq::categories');
        $resultPage->getConfig()->getTitle()->prepend((__('Categories')));
        $resultPage->addBreadcrumb(__('FAQ'), __('FAQ'));

        return $resultPage;
    }

    protected function _isAllowed(){
        return $this->_authorization->isAllowed('Rukhsar_Faq::categories');
    }
}
