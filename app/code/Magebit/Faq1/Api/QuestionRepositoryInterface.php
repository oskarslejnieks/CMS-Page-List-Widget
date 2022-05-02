<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Api;

use Magebit\Faq1\Api\Data\QuestionInterface;
use Magebit\Faq1\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Interface that has list of declared methods
 */
interface QuestionRepositoryInterface
{
    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question): QuestionInterface;

    /**
     * @param $questionId
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function get($questionId): QuestionInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface;

    /**
     * @param QuestionInterface $question
     * @return bool true on success
     */
    public function delete(QuestionInterface $question): bool;

    /**
     * @param int $questionId
     * @return bool
     */
    public function deleteById(int $questionId): bool;

}
