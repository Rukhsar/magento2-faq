<?php

namespace Rukhsar\Faq\Controller\Adminhtml\Groups;

use Magento\Backend\App\Action;

/**
 * Class Edit
 *
 * @package Rukhsar\Faq\Controller\Adminhtml\Groups
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Edit constructor.
     *
     * @param \Magento\Backend\App\Action\Context        $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry                $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Rukhsar\Faq\Model\Group');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->coreRegistry->register('group', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Rukhsar_Faq::groups')
            ->addBreadcrumb(__('FAQ'), __('FAQ'))
            ->addBreadcrumb(__('Groups'), __('Groups'))
            ->addBreadcrumb(__('Edit'), __('Edit'));

        $resultPage->getConfig()->getTitle()->prepend(__('FAQ'));
        $resultPage->getConfig()->getTitle()->prepend(__('Groups'));
        $resultPage->getConfig()->getTitle()->prepend(__('Edit'));
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
