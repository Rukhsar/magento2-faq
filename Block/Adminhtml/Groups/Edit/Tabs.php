<?php

namespace Rukhsar\Faq\Block\Adminhtml\Groups\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

/**
 * Class Tabs
 *
 * @package Rukhsar\Faq\Block\Adminhtml\Groups\Edit
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Tabs extends WidgetTabs
{
    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('group_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Group'));
    }

    /**
     * @return \Magento\Backend\Block\Widget\Tabs
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general_data',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'Rukhsar\Faq\Block\Adminhtml\Groups\Edit\Tab\General'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}
