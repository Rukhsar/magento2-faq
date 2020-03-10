<?php

namespace Rukhsar\Faq\Ui\Component\Listing\Column;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class ParentCategory
 *
 * @package Rukhsar\Faq\Ui\Component\Listing\Column
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class ParentCategory extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * ParentCategory constructor.
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param \Magento\Store\Model\StoreManagerInterface                   $storeManager
     * @param \Magento\Framework\ObjectManagerInterface                    $objectManager
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $components = [],
        array $data = []
    )
    {
        $this->storeManager = $storeManager;
        $this->objectManager = $objectManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach($dataSource['data']['items'] as & $item) {
                if($item && isset($item['parent_id']) && $item['parent_id'] > 0) {
                    $category = $this->objectManager->get('Rukhsar\Faq\Model\Category')->load($item['parent_id']);
                    if($category->getId()){
                        $title = $category->getTitle();
                        $parentId = $category->getData('parent_id');
                        if($parentId != false && $parentId > 0){
                            do {
                                $parent = $this->objectManager->get('Rukhsar\Faq\Model\Category')->load($parentId);
                                if($parent->getTitle()){
                                    $title = $parent->getTitle().' - '.$title;
                                }
                                if($parent->getParentId() > 0){
                                    $parentId = $parent->getParentId();
                                }
                                else{
                                    $parentId = false;
                                }
                            } while ($parentId != false && $parentId > 0);
                        }
                        $item['parent_id'] = $title;
                    }
                    else{
                        $item['parent_id'] = NULL;
                    }
                }
                else{
                    $item['parent_id'] = NULL;
                }
            }
        }
        return $dataSource;
    }
}
