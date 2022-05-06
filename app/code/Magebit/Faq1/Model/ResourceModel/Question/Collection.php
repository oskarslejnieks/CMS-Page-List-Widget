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

namespace Magebit\Faq1\Model\ResourceModel\Question;

use Magebit\Faq1\Api\Data\QuestionInterface;
use Magebit\Faq1\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq1\Model\Question as Question;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * This is a collection model that allow us to filter and fetch a collection table data.
 */
abstract class Collection extends AbstractCollection implements AdapterInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = QuestionInterface::IDFIELDNAME;

    /**
     * Define model & resource model
     *
     */
    protected function _construct(){
        $this->_init(Question::class, ResourceQuestion::class);
    }
}
