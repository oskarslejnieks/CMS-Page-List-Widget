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

use Magebit\Faq1\Api\Data\QuestionInterface;
use Magebit\Faq1\Api\QuestionManagementInterface;
use Magebit\Faq1\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Management class that contains logic of disableQuestion and enableQuestion
 */

class QuestionManagement implements QuestionManagementInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct
    (
        QuestionRepositoryInterface $questionRepository
    ){
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param int $questionId
     * @return bool
     * @throws CouldNotSaveException
     */
    public function disableQuestion(int $questionId): bool
    {
        $question = $this->questionRepository->get($questionId);
        $question->setStatus(QuestionInterface::DISABLED);
        $this->questionRepository->save($question);

        return true;
    }

    /**
     * @param int $questionId
     * @return bool
     * @throws CouldNotSaveException
     */
    public function enableQuestion(int $questionId): bool
    {
        $question = $this->questionRepository->get($questionId);
        $question->setStatus(QuestionInterface::ENABLED);
        $this->questionRepository->save($question);

        return true;
    }
}
