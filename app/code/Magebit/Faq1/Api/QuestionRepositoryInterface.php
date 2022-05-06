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
     * Save method. Saves altered or newly created questions to database
     *
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question): QuestionInterface;

    /**
     * Get method. Gets specific question out of the database
     *
     * @param int $questionId
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function get(int $questionId): QuestionInterface;

    /**
     * Get List method. Gets list of questions out of the database
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface;

    /**
     * Delete method. Deletes array of questions out of the database
     *
     * @param QuestionInterface $question
     * @return bool true on success
     */
    public function delete(QuestionInterface $question): bool;

    /**
     * Delete by ID method. Deletes specific question out of the database.
     *
     * @param int $questionId
     * @return bool
     */
    public function deleteById(int $questionId): bool;
}
