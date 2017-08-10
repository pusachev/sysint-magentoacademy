<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Block\Adminhtml\Lessons\Edit\Tab;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

class General extends AbstractTab
{
    const TAB_LABEL     = 'General';
    const TAB_TITLE     = 'General';

    /** {@inheritdoc} */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('lesson_');
        $form->setFieldNameSuffix('lesson');

        $fieldSet = $form->addFieldset(
            'general_fieldset',
            ['legend' => __('General')]
        );

        if ($this->model->getData(LessonsInterface::ID_FIELD)) {
            $fieldSet->addField(
                LessonsInterface::ID_FIELD,
                'hidden',
                ['name' => LessonsInterface::ID_FIELD]
            );
        }

        $fieldSet->addField(
            LessonsInterface::SPEAKER_FIELD,
            'text',
            [
                'name'      => LessonsInterface::SPEAKER_FIELD,
                'label'     => __('Speaker'),
                'required'  => true
            ]
        );

        $fieldSet->addField(
            LessonsInterface::TITLE_FIELD,
            'text',
            [
                'name'      => LessonsInterface::TITLE_FIELD,
                'label'     => __('Title'),
                'required'  => true
            ]
        );

        $fieldSet->addField(
            LessonsInterface::SHORT_DESCRIPTION_FILED,
            'editor',
            [
                'name'      => LessonsInterface::SHORT_DESCRIPTION_FILED,
                'label'     => __('Short Description'),
                'required'  => true,
                'config'    => $this->wysiwygConfig->getConfig()
            ]
        );

        $fieldSet->addField(
            LessonsInterface::START_DATE_FIELD,
            'date',
            [
                'name'          => LessonsInterface::START_DATE_FIELD,
                'label'         => __('Start'),
                'date_format'   => 'yyyy-MM-dd',
                'time_format'   => 'hh:mm:ss',
                'required'      => true
            ]
        );

        $fieldSet->addField(
            LessonsInterface::END_DATE_FIELD,
            'date',
            [
                'name'          => LessonsInterface::END_DATE_FIELD,
                'label'         => __('End'),
                'date_format'   => 'yyyy-MM-dd',
                'time_format'   => 'hh:mm:ss',
                'required'      => true
            ]
        );

        $data = $this->model->getData();

        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
