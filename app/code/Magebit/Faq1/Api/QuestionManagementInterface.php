<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Api;

use Magebit\Faq1\Api\Data\QuestionInterface;

/**
 * Interface that defines 2 methods - enableQuestion and DisableQuestion
 */
interface QuestionManagementInterface
{
    /**
     * @param QuestionInterface $question
     * @return bool
     */
    public function enableQuestion(QuestionInterface $question): bool;

    /**
     * @param QuestionInterface $question
     * @return bool
     */
    public function disableQuestion(QuestionInterface $question): bool;
}
