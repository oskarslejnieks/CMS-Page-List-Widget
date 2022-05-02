<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Model;


use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

use Magebit\Faq1\Api\Data\QuestionSearchResultsInterface;
use Magebit\Faq1\Api\Data\QuestionInterface;
use Magebit\Faq1\Api\Data\QuestionSearchResultsInterfaceFactory;
use Magebit\Faq1\Api\QuestionRepositoryInterface;
use Magebit\Faq1\Model\ResourceModel\Question;
use Magebit\Faq1\Model\ResourceModel\Question\CollectionFactory;

/**
 * Model file where our declared methods are defined.
 */
class QuestionRepository implements QuestionRepositoryInterface
{

    protected QuestionFactory $questionFactory;

    private Question $questionResource;

    private CollectionFactory $questionCollectionFactory;

    protected QuestionSearchResultsInterfaceFactory $searchResultsFactory;

    protected CollectionProcessorInterface $collectionProcessor;

    public function __construct(
        QuestionFactory $questionFactory,
        Question $questionResource,
        CollectionFactory $questionCollectionFactory,
        QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->questionFactory = $questionFactory;
        $this->questionResource = $questionResource;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $questionSearchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws LocalizedException
     */
    public function save(QuestionInterface $question): QuestionInterface
    {
        $this->questionResource->save($question);
        return $question;
    }

    /**
     * @param int $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function get($questionId): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->questionResource->load($question, $questionId);
        if(!$question->getId())
        {
            throw new NoSuchEntityException(__('Unable to find Question with ID "%1"', $questionId));
        }
        return $question;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface
    {
        $collection = $this->questionCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * @param QuestionInterface $question
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(QuestionInterface $question): bool
    {
        try {
            $this->questionResource->delete($question);
        }
        catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * @param int $questionId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $questionId): bool
    {
        return $this->delete($this->get($questionId));
    }
}
