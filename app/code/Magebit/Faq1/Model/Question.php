<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Model;

use Magento\Framework\Model\AbstractModel;
use Magebit\Faq1\Model\ResourceModel\Question as ResourceModel;
use Magebit\Faq1\Api\Data\QuestionInterface;

/**
 * Model class extends AbstractModel and implements QuestionInterface. Question interface will force model class to define getId, getQuestion,
 * etc... methods which will return a unique id. _init method in constuctor will define the resource model that actually fetches information from database.
 */
class Question extends AbstractModel implements QuestionInterface
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::Class);
    }

    /**
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->getData(self::QUESTION_ID);
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param $question
     * @return Question
     */
    public function setQuestion($question): Question
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @param $answer
     * @return Question
     */
    public function setAnswer($answer): Question
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @param $status
     * @return Question
     */
    public function setStatus($status): Question
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @param $position
     * @return Question
     */
    public function setPosition($position): Question
    {
        return $this->setData(self::POSITION, $position);
    }
}
