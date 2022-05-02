<?php

namespace Magebit\Faq1\Block;

use Magebit\Faq1\Api\Data\QuestionInterface;
use Magebit\Faq1\Model\QuestionRepository;
use Magebit\Faq1\Model\ResourceModel\Question\Collection;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Api\SortOrderBuilder;
use Magebit\Faq1\Model\ResourceModel\Question\CollectionFactory;


/**
 * Block class that shows content on frontend, filters only enabled content and filters faq positions
 */
class QuestionList extends Template
{
    /**
     * @var SortOrderBuilder
     */
    protected SortOrderBuilder $sortOrderBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var FilterGroupBuilder
     */
    protected FilterGroupBuilder $filterGroupBuilder;

    /**
     * @var QuestionRepository
     */
    private QuestionRepository $questionRepository;

    /**
     * @var FilterBuilder
     */
    private FilterBuilder $filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    private FilterGroupBuilder $filterGroup;

    /**
     * @param Context $context
     * @param QuestionRepository $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        QuestionRepository $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterGroup = $filterGroupBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->filterBuilder = $filterBuilder;

        parent::__construct($context, $data);
    }


    /**
     * @return array
     * @throws LocalizedException
     */
    public function getQuestions(): array
    {
        $sortOrder = $this->sortOrderBuilder->setField('position')->setDirection('ASC')->create();

        $filter = $this->filterBuilder->setField(QuestionInterface::STATUS)
            ->setConditionType('like')
            ->setValue('1')
            ->create();

        $this->searchCriteriaBuilder->addFilters([$filter])->setSortOrders([$sortOrder]);

        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->questionRepository->getList($searchCriteria)->getItems();
    }
}
