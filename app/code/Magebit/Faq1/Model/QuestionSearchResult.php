<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magebit\Faq1\Model;

use Magebit\Faq1\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Page search results.
 */
class QuestionSearchResult extends SearchResults implements QuestionSearchResultsInterface
{

}
