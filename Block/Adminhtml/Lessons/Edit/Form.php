<?php

namespace Sysint\MagentoAcademy\Block\Adminhtml\Lessons\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /** {@inheritdoc} */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id'    => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
