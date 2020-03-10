<?php

namespace Rukhsar\Faq\Model\Config\Source;

/**
 * Class Categories
 *
 * @package Rukhsar\Faq\Model\Config\Source
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Categories implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Categories constructor.
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $array = [
            ['value' => '0', 'label' => __('None')]
        ];

        $collection = $this->objectManager->get('Rukhsar\Faq\Model\Category')->getCollection();
        if ($collection->count() > 0) {
            foreach ($collection as $category) {
                $title = $category->getTitle();
                $parentId = $category->getData('parent_id');
                if ($parentId != false && $parentId > 0) {
                    do {
                        $parent = $this->objectManager->get('Rukhsar\Faq\Model\Category')->load($parentId);
                        if ($parent->getTitle()) {
                            $title = $parent->getTitle(). ' - '. $title;
                        }
                        if ($parent->getParentId() > 0) {
                            $parentId = $parent->getParentId();
                        } else {
                            $parentId = false;
                        }
                    } while ($parentId != false);
                }
                $item = [
                    'value' =>  $category->getId(),
                    'label' =>  $title
                ];
                $array[] = $item;
            }
        }
        return $array;
    }
}
