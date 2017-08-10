<?php

namespace Sysint\MagentoAcademy\Block\Adminhtml\Lessons;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

class Edit extends Container
{
    /** @var Registry */
    protected $registry;

    /** @var string */
    private $headerText;
    /**
     * Edit constructor.
     * @param Context   $context
     * @param Registry  $registry
     * @param array     $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_objectId   = 'id';
        $this->_controller = 'adminhtml_lessons';
        $this->_blockGroup = 'Sysint_MagentoAcademy';

        parent::_construct();

        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
    }

    /** {@inheritdoc} */
    public function getHeaderText()
    {
        $model = $this->registry->registry(LessonsInterface::REGISTRY_KEY);
        if ($model->getId()) {
            $this->headerText = __("Edit item '%1'", $model->getId());
        } else {
            $this->headerText = __('Create new item');
        }

        return $this->headerText;
    }

    /** {@inheritdoc} */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('post_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'post_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'post_content');
                }
            };
        ";

        return parent::_prepareLayout();
    }
}
