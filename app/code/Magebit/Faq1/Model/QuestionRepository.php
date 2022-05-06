<?php
/**
 * This file is part of the Magebit FAQ1 package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_Faq1
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2022 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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
    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;

    /**
     * @var Question
     */
    private Question $questionResource;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $questionCollectionFactory;

    /**
     * @var QuestionSearchResultsInterfaceFactory
     */
    protected QuestionSearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected CollectionProcessorInterface $collectionProcessor;

    /**
     * @param QuestionFactory $questionFactory
     * @param Question $questionResource
     * @param CollectionFactory $questionCollectionFactory
     * @param QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        QuestionFactory $questionFactory,
        Question $questionResource,
        CollectionFactory $questionCollectionFactory,
        QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ){
        $this->questionFactory = $questionFactory;
        $this->questionResource = $questionResource;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $questionSearchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save method. Saves altered or newly created questions to database
     *
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
     * Get method. Gets specific question out of the database
     *
     * @param int $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function get(int $questionId): QuestionInterface
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
     * Get List method. Gets list of questions out of the database
     *
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
     * Delete method. Deletes array of questions out of the database
     *
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
     * Delete by ID method. Deletes specific question out of the database.
     *
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
