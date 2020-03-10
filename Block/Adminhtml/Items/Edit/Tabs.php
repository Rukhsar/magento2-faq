<?php

namespace Rukhsar\Faq\Block\Adminhtml\Items\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

/**
 * Class Tabs
 *
 * @package Rukhsar\Faq\Block\Adminhtml\Items\Edit
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
		$this->setId('item_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Item'));
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
					'Rukhsar\Faq\Block\Adminhtml\Items\Edit\Tab\General'
				)->toHtml(),
				'active' => true
			]
		);
		return parent::_beforeToHtml();
	}
}
