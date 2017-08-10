<?php

namespace Sysint\MagentoAcademy\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;

interface LessonsRepositoryInterface
{
    /**
     * @param int $id
     * @return LessonsInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return LessonsRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return LessonsInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param LessonsInterface $lessons
     * @return LessonsInterface
     * @throws CouldNotSaveException
     */
    public function save(LessonsInterface $lessons);

    /**
     * @param LessonsInterface $lessons
     * @return LessonsRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(LessonsInterface $lessons);
}
