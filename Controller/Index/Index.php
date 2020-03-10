<?php
namespace Rukhsar\Faq\Controller\Index;

/**
 * Class Index
 *
 * @package Rukhsar\Faq\Controller\Index
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Registry $registry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $registry;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
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
                    else{
                        $this->_forward('index', 'noroute', 'cms');
                    }
                }
            }
            return $this->resultFactory->create(
                \Magento\Framework\Controller\ResultFactory::TYPE_PAGE
            );
        }
        else{
            $this->_forward('index', 'noroute', 'cms');
        }
    }
}
