<?php
namespace Rukhsar\Faq\Model\ResourceModel\Item;

/**
 * Class Collection
 *
 * @package Rukhsar\Faq\Model\ResourceModel\Item
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 *
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'rukhsar_faq_item_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'item_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Rukhsar\Faq\Model\Item', 'Rukhsar\Faq\Model\ResourceModel\Item');
    }
}
