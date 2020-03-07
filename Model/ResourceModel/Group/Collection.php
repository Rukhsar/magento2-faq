<?php
namespace Rukhsar\Faq\Model\ResourceModel\Group;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'rukhsar_faq_group_collection';
    protected $_eventObject = 'group_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Rukhsar\Faq\Model\Group', 'Rukhsar\Faq\Model\ResourceModel\Group');
    }
}
