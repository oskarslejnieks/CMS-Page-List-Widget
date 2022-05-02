<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Model;

use Magebit\Faq1\Api\QuestionManagementInterface;
use Magebit\Faq1\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Management class that contains logic of disableQuestion and enableQuestion
 */

class QuestionManagement implements QuestionManagementInterface
{

    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct
    (
        QuestionRepositoryInterface $questionRepository
    )
    {
        $this->questionRepository = $questionRepository;
    }


    /**
     * @param $id
     * @return bool
     * @throws CouldNotSaveException
     */
    public function disableQuestion($id): bool
    {
        $question = $this->questionRepository->get($id);
        $question->setStatus(0);
        $this->questionRepository->save($question);

        return $this->disableQuestion($id);
    }

    /**
     * @param $id
     * @return bool
     * @throws CouldNotSaveException
     */
    public function enableQuestion($id): bool
    {
        $question = $this->questionRepository->get($id);
        $question->setStatus(1);
        $this->questionRepository->save($question);

        return $this->enableQuestion($id);
    }
}
