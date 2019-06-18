<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Api;

interface LessonsRepositoryInterface
{
    /**
     * @param int $id
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return \Sysint\MagentoAcademy\Api\LessonsRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Sysint\MagentoAcademy\Api\Data\LessonsInterface $lessons
     * @return \Sysint\MagentoAcademy\Api\Data\LessonsInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Sysint\MagentoAcademy\Api\Data\LessonsInterface $lessons);

    /**
     * @param \Sysint\MagentoAcademy\Api\Data\LessonsInterface $lessons
     * @return \Sysint\MagentoAcademy\Api\LessonsRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Sysint\MagentoAcademy\Api\Data\LessonsInterface $lessons);
}
