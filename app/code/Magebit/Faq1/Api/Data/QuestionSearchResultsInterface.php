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

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface that defines getters and setters for Item arrays. Search results interface
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Item List. Returns all items in array.
     * @return array
     */
    public function getItems();

    /**
     * Set Item List.
     * @param QuestionInterface[]
     * @return QuestionSearchResultsInterface
     */
    public function setItems(array $items);
}
