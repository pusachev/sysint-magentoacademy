<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Block\Adminhtml\Lessons\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

use Sysint\MagentoAcademy\Block\Adminhtml\Lessons\Edit\Tab\General as GeneralTab;

class Tabs extends WidgetTabs
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('sysint_magentoacademy_lessons_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Lesson information'));
    }
    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    GeneralTab::class
                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}
