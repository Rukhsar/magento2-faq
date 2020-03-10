<?php

namespace Rukhsar\Faq\Block\Adminhtml\Items;

/**
 * Class Edit
 *
 * @package Rukhsar\Faq\Block\Adminhtml\Items
 * @author  Rukhsar Manzoor <rukhsar.man@gmail.com>
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry           $registry
     * @param array                                 $data
     */public function __construct(
		\Magento\Backend\Block\Widget\Context $context,
		\Magento\Framework\Registry $registry,
		array $data = []
	)
    {
		$this->_coreRegistry = $registry;
		parent::__construct($context, $data);
	}

    /**
     *
     */
    protected function _construct()
    {
		$this->_objectId = 'item_id';
		$this->_blockGroup = 'Rukhsar_Faq';
		$this->_controller = 'adminhtml_items';
		parent::_construct();
		if ($this->_isAllowedAction('Rukhsar_Faq::items')) {
			$this->buttonList->remove('reset');
			$this->buttonList->update('save', 'label', __('Save Item'));
			$this->buttonList->add(
				'saveandcontinue',
				[
					'label' => __('Save and Continue Edit'),
					'class' => 'save',
					'data_attribute' => [
						'mage-init' => [
							'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
						],
					]
				],
				-100
			);
		} else {
			$this->buttonList->remove('save');
		}
		if ($this->_isAllowedAction('Rukhsar_Faq::items')) {
			$this->buttonList->update('delete', 'label', __('Delete Item'));
		} else {
			$this->buttonList->remove('delete');
		}
	}

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getHeaderText()
    {
		if ($this->_coreRegistry->registry('item')->getId()) {
			return __("Edit Item '%1'", $this->escapeHtml($this->_coreRegistry->registry('item')->getId()));
		} else {
			return __('New Item');
		}
	}

    /**
     * @param $resourceId
     *
     * @return bool
     */protected function _isAllowedAction($resourceId)
    {
		return $this->_authorization->isAllowed($resourceId);
	}

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
		return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
	}

    /**
     * @return \Magento\Backend\Block\Widget\Form\Container
     */
    protected function _prepareLayout()
    {
		$this->_formScripts[] = "
			function toggleEditor() {
				if (tinyMCE.getInstanceById('general_content') == null) {
					tinyMCE.execCommand('mceAddControl', false, 'general_content');
				} else {
					tinyMCE.execCommand('mceRemoveControl', false, 'general_content');
				}
			};
		";
		return parent::_prepareLayout();
	}
}
