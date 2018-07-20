<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace Sysint\MagentoAcademy\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;

use Sysint\MagentoAcademy\Api\LessonsRepositoryInterface;
use Sysint\MagentoAcademy\Api\Data\LessonsSearchResultsInterface;

class LessonsList extends Template
{
    /** @var SearchCriteriaBuilder */
    protected $searchCriteria;

    /** @var LessonsRepositoryInterface */
    protected $repository;

    /**
     * @param Context                       $context
     * @param LessonsRepositoryInterface    $lessonsRepository
     * @param SearchCriteriaBuilder         $searchCriteriaBuilder
     * @param array                         $data
     */
    public function __construct(
        Context $context,
        LessonsRepositoryInterface $lessonsRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->repository       = $lessonsRepository;
        $this->searchCriteria   = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @return LessonsSearchResultsInterface
     */
    public function getActualLessonsList()
    {
        $today = new \DateTime();
        $searchCriteria = $this->searchCriteria
                              ->addFilter('end_date', $today, 'gteq')
                              ->addFilter('start_date', $today, 'lteq')
                              ->create();

        $searchResult = $this->repository->getList($searchCriteria);

        return $searchResult;
    }
}
