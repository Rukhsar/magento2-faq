<?php
namespace Rukhsar\Faq\Model\ResourceModel\Item;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'rukhsar_faq_item_collection';
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
