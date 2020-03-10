<?php

namespace Rukhsar\Faq\Controller\Adminhtml\Groups;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

/**
 * Class Delete
 *
 * @package Rukhsar\Faq\Controller\Adminhtml\Groups
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Delete extends Action
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
     * Delete constructor.
     *
     * @param \Magento\Backend\App\Action\Context        $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct
    (
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id>0) {
            $model = $this->_objectManager->create('Rukhsar\Faq\Model\Group');
            $model->load($id);
            try {
                $model->delete();
                $this->messageManager->addSuccess(__('Deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addSuccess(__('Something went wrong.'));
            }
        }
        $this->_redirect('*/*');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Rukhsar_Faq::groups');
    }
}
