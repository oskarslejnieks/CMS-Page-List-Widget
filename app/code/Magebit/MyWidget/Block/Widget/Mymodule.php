<?php
/**
 * This file is part of the Magebit MyWidget package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit_MyWidget
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

namespace Magebit\MyWidget\Block\Widget;

use Magento\Framework\Exception\LocalizedException;
use \Magento\Widget\Block\BlockInterface;
use \Magento\Framework\View\Element\Html\Link;
use \Magento\Cms\Api\PageRepositoryInterface;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use \Magento\Cms\Model\PageFactory;

class Mymodule extends Link implements BlockInterface
{
    protected $_template = "page-list.phtml";

    /** @var PageRepositoryInterface */
    protected PageRepositoryInterface $_pageRepositoryInterface;

    /** @var SearchCriteriaBuilder */
    protected SearchCriteriaBuilder $_searchCriteriaBuilder;

    /**
     * @var PageFactory
     */
    protected PageFactory $_pageFactory;

    /**
     * @param Context $context
     * @param PageRepositoryInterface $pageRepositoryInterface ,
     * @param SearchCriteriaBuilder $searchCriteriaBuilder ,
     * @param PageFactory $pageFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PageFactory $pageFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_pageRepositoryInterface = $pageRepositoryInterface;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_pageFactory = $pageFactory;
    }

    /**
     * Get Pages Collection from site
     *
     * @return array
     * @throws LocalizedException
     */

    public function getCmsPageCollection(): array
    {
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        return $this->_pageRepositoryInterface->getList($searchCriteria)->getItems();
    }

    /**
     * Get Page collection with urlKey parameter
     *
     * @param $urlKey
     * @return array
     * @throws LocalizedException
     */
    public function getCmsPageDetails($urlKey): array
    {
        if(!empty($urlKey))
        {
            $searchCriteria = $this->_searchCriteriaBuilder->addFilter('identifier', $urlKey,'eq')->create();
            $pages = $this->_pageRepositoryInterface->getList($searchCriteria)->getItems();

        }
        return $pages;
    }
}
