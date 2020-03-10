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
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->_pageFactory->create(
            \Magento\Framework\Controller\ResultFactory::TYPE_PAGE
        );
    }
}
