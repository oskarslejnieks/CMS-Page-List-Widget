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
     * Get ID
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData(self::QUESTION_ID);
    }

    /**
     * Get Question
     * @return string|null
     */
    public function getQuestion(): ?string
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * Get Answer
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Get Status
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get Position
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->getData(self::POSITION);
    }

    /**
     * get Updated At
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set Question
     * @type string
     * @param $question
     * @return QuestionInterface
     */
    public function setQuestion($question): QuestionInterface
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Set Answer
     * @type string
     * @param $answer
     * @return QuestionInterface
     */
    public function setAnswer($answer): QuestionInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set Status
     * @type int
     * @param $status
     * @return QuestionInterface
     */
    public function setStatus($status): QuestionInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set Position
     * @type int
     * @param $position
     * @return QuestionInterface
     */
    public function setPosition($position): QuestionInterface
    {
        return $this->setData(self::POSITION, $position);
    }
}
