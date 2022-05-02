<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq1\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface that defines getters and setters for Item arrays
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return QuestionInterface[]
     */
    public function getItems();

    /**
     * @param QuestionInterface[]
     * @return QuestionSearchResultsInterface
     */
    public function setItems(array $items);
}
