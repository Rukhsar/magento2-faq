<?php

namespace Rukhsar\Faq\Block\Adminhtml\Categories\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

/**
 * Class Tabs
 *
 * @package Rukhsar\Faq\Block\Adminhtml\Categories\Edit
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
        $this->setId('category_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Category'));
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
                    'Rukhsar\Faq\Block\Adminhtml\Categories\Edit\Tab\General'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }

}
