<?php

namespace Rukhsar\Faq\Controller\Category;

use Magento\Framework\App\Action\Action;

/**
 * Class View
 *
 * @package Rukhsar\Faq\Controller\Category
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class View extends Action
{
    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * View constructor.
     *
     * @param \Magento\Framework\App\Action\Context      $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry                $registry
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $helper = $this->_objectManager->get('Rukhsar\Faq\Helper\Data');
        $storeManager = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
        if ($helper->getConfigValue('general/active', $storeManager->getStore()->getData('store_id')) == "1") {
            if ($this->getRequest()->getParam('id')) {
                $category = $this->_objectManager->get('Rukhsar\Faq\Model\Category')->load(
                    $this->getRequest()->getParam('id')
                );
                if ($category->getId()) {
                    if ($category->getActive()) {
                        $this->_coreRegistry->register('category', $category);
                    }
                    else {
                        $this->_forward('index', 'noroute', 'cms');
                    }
                }
            }
            return $this->resultFactory->create(
                \Magento\Framework\Controller\ResultFactory::TYPE_PAGE
            );
        }
        else {
            $this->_forward('index', 'noroute', 'cms');
        }
    }
}
