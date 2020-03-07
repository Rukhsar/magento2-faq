<?php
namespace Rukhsar\Faq\Model\ResourceModel\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'rukhsar_faq_category_collection';
    protected $_eventObject = 'category_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Rukhsar\Faq\Model\Category', 'Rukhsar\Faq\Model\ResourceModel\Category');
    }
}
