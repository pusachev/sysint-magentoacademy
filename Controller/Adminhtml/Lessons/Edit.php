<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Controller\Adminhtml\Lessons;

use Magento\Framework\Exception\NoSuchEntityException;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Controller\Adminhtml\Lessons as BaseAction;

class Edit extends BaseAction
{
    const ACL_RESOURCE      = 'Sysint_MagentoAcademy::edit';
    const MENU_ITEM         = 'Sysint_MagentoAcademy::edit';
    const PAGE_TITLE        = 'Edit Lesson';
    const BREADCRUMB_TITLE  = 'Edit Lesson';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }

        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Lesson not found");
            return $this->redirectToGrid();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(LessonsInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}
