<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2018, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Block\Adminhtml\Lessons\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var LessonsRepositoryInterface */
    protected $repository;

    public function __construct(
        Context $context,
        LessonsRepositoryInterface $repository
    ) {
        $this->context      = $context;
        $this->repository   = $repository;
    }

    /**
     * Return Lesson ID
     *
     * @return int|null
     */
    public function getLessonId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}