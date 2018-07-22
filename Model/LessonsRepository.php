<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Sysint\MagentoAcademy\Api\Data\LessonsInterface;
use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface;
use Sysint\MagentoAcademy\Api\Data\LessonsSearchResultsInterfaceFactory;
use Sysint\MagentoAcademy\Model\ResourceModel\Lessons as ResourceModel;
use Sysint\MagentoAcademy\Model\LessonsFactory;
use Sysint\MagentoAcademy\Model\ResourceModel\Lessons\CollectionFactory;

class LessonsRepository implements LessonsRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;

    /** @var LessonsFactory  */
    protected $lessonsFactory;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var CollectionFactory */
    protected $collectionFactory;

    /** @var LessonsSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    public function __construct(
        ResourceModel $resource,
        LessonsFactory $lessonsFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        LessonsSearchResultsInterfaceFactory $lessonsSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->lessonsFactory           = $lessonsFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $lessonsSearchResultsFactory;
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

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
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
