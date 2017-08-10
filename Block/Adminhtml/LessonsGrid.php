<?php

namespace Sysint\MagentoAcademy\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class LessonsGrid extends Container
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_lessons';
        $this->_blockGroup = 'Sysint_MagentoAcademy';
        $this->_headerText = __('Lessons');
        $this->_addButtonLabel = __('Create new');
        parent::_construct();
    }

    /** {@inheritdoc} */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/create');
    }
}
