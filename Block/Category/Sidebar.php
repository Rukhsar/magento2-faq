<?php

namespace Rukhsar\Faq\Block\Category;

/**
 * Class Sidebar
 *
 * @package Rukhsar\Faq\Block\Category
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Sidebar extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * Sidebar constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\ObjectManagerInterface        $objectManager
     * @param \Magento\Framework\Registry                      $registry
     * @param array                                            $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_registry = $registry;
        $this->_objectManager = $objectManager;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_registry->registry('category');
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getItems()
    {
        $catId = $this->_objectManager->get('\Rukhsar\Faq\Helper\Data')->getDefaultCategory(
            $this->_storeManager->getStore()->getId()
        );

        if ($this->getCategory()) {
            $catId = $this->getCategory()->getId();
        }

        $collection = $this->_objectManager->get('\Rukhsar\Faq\Model\Category')->getCollection();
        $collection->addFieldToFilter('active', true);
        $collection->addFieldToFilter('parent_id', $catId);
        $collection->setOrder('sort', 'asc');
        return $collection;
    }
}
