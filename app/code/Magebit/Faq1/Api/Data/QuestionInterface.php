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

    const MAINTABLE = 'faq1';
    CONST IDFIELDNAME = 'id';

    const DISABLED = 0;
    const ENABLED = 1;

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Get Question
     *
     * @return string|null
     */
    public function getQuestion(): ?string;

    /**
     * Get Answer
     *
     * @return string|null
     */
    public function getAnswer(): ?string;

    /**
     * Get Status
     *
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * Get Position
     *
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * Get Updated At
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set Question
     *
     * @type string
     * @param $question
     */
    public function setQuestion($question): QuestionInterface;

    /**
     * Set Answer
     *
     * @type string
     * @param $answer
     */
    public function setAnswer($answer): QuestionInterface;

    /**
     * Set Status
     *
     * @type integer
     * @param $status
     */
    public function setStatus($status): QuestionInterface;

    /**
     * Set Position
     *
     * @type integer
     * @param $position
     */
    public function setPosition($position): QuestionInterface;
}
