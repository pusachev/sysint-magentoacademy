<?php

namespace Sysint\MagentoAcademy\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface;
use Sysint\MagentoAcademy\Model\ResourceModel\Lessons as ResourceModel;
use Sysint\MagentoAcademy\Model\LessonsFactory;

class LessonsRepository implements LessonsRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;

    /** @var LessonsFactory  */
    protected $lessonsFactory;

    public function __construct(
        ResourceModel $resource,
        LessonsFactory $lessonsFactory
    ) {
        $this->resource         = $resource;
        $this->lessonsFactory   = $lessonsFactory;
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $lessons = $this->lessonsFactory->create();
        $this->resource->load($lessons, $id);

        if (!$lessons->getId()) {
            throw new NoSuchEntityException(__('Lesson with id "%1" does not exist.', $id));
        }

        return $lessons;
    }

    /**
     * @param int $id
     * @return LessonsRepositoryInterface
     */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }

    /** {@inheritdoc} */
    public function save(LessonsInterface $lessons)
    {
        try {
            $this->resource->save($lessons);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $lessons;
    }

    /** {@inheritdoc} */
    public function delete(LessonsInterface $lessons)
    {
        try {
            $this->resource->delete($lessons);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}