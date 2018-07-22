<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Controller\Adminhtml\Lessons;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Controller\Adminhtml\Lessons as BaseAction;

class Save extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('lesson');

            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }

            if(!empty($formData[LessonsInterface::ID_FIELD])) {
                $id = $formData[LessonsInterface::ID_FIELD];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[LessonsInterface::ID_FIELD]);
            }

            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Lesson has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Lesson doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }

        return $this->doRefererRedirect();
    }
}
