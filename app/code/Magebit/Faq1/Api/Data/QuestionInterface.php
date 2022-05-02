<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface that defines all variables required getters and setters
 */
interface QuestionInterface extends ExtensibleDataInterface
{
    const QUESTION_ID = 'id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const STATUS = 'status';
    const POSITION = 'position';
    const UPDATED_AT = 'updated_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Get Question
     *
     * @return string
     */
    public function getQuestion(): string;

    /**
     * Get Answer
     *
     * @return string
     */
    public function getAnswer(): string;

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Get Position
     *
     * @return int
     */
    public function getPosition(): int;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set Question
     *
     * @param $question
     */
    public function setQuestion($question);

    /**
     * Set Answer
     *
     * @param $answer
     */
    public function setAnswer($answer);

    /**
     * Set Status
     *
     * @param $status
     */
    public function setStatus($status);

    /**
     * Set Position
     *
     * @param $position
     */
    public function setPosition($position);
}
