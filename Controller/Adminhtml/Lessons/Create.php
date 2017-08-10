<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Controller\Adminhtml\Lessons;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Controller\Adminhtml\Lessons as BaseAction;

class Create extends BaseAction
{
    const ACL_RESOURCE      = 'Sysint_MagentoAcademy::create';
    const MENU_ITEM         = 'Sysint_MagentoAcademy::create';
    const PAGE_TITLE        = 'Add Lesson';
    const BREADCRUMB_TITLE  = 'Add Lesson';

    public function execute()
    {
        $model = $this->getModel();

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(LessonsInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}
