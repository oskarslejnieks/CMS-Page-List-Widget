<?php
 
namespace Magebit\MyWidget\Block\Widget;
 
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use \Magento\Framework\View\Element\Html\Link;
use Magento\Cms\Api;
 
class Mymodule extends Link implements BlockInterface {
    
    /** @var PageRepositoryInterface */
    protected $_pageRepositoryInterface;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_pageRepositoryInterface = $pageRepositoryInterface;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    // Get CMS Page Collection

    public function getCmsPageCollection() 
    {
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $cmsPages = $this->_pageRepositoryInterface->getList($searchCriteria)->getItems();
        return $cmsPages;
    }

    public function getCurrentPage()
    {
        return $this->context->getFullActionName();
    }
    
    protected $_template = "page-list.phtml";
    
}