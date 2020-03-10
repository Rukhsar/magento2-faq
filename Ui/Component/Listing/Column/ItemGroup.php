<?php

namespace Rukhsar\Faq\Ui\Component\Listing\Column;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class ItemGroup
 *
 * @package Rukhsar\Faq\Ui\Component\Listing\Column
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class ItemGroup extends \Magento\Ui\Component\Listing\Columns\Column
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
     * ItemGroup constructor.
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param \Magento\Store\Model\StoreManagerInterface                   $storeManager
     * @param \Magento\Framework\ObjectManagerInterface                    $objectmanager
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        array $components = [],
        array $data = []
    )
    {
        $this->objectManager = $objectmanager;
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
            foreach($dataSource['data']['items'] as & $item) {
                if($item && isset($item['group_id']) && $item['group_id'] > 0) {
                    $group = $this->objectManager->get('Rukhsar\Faq\Model\Group')->load($item['group_id']);
                    if ($group->getId()) {
                        $title = $group->getData('title');
                        $categoryId = $group->getData('category_id');
                        if ($categoryId != false && $categoryId > 0) {
                            do {
                                $category = $this->objectManager->get('Rukhsar\Faq\Model\Category')->load($categoryId);
                                if ($category->getTitle()) {
                                    $title = $category->getTitle().' - '.$title;
                                }
                                if ($category->getParentId() > 0) {
                                    $categoryId = $category->getParentId();
                                }
                                else {
                                    $categoryId = false;
                                }
                            } while ($categoryId != false);
                        }
                        $item['group_id'] = $title;
                    }
                    else{
                        $item['group_id'] = NULL;
                    }
                }
                else{
                    $item['group_id'] = NULL;
                }
            }
        }
        return $dataSource;
    }
}
