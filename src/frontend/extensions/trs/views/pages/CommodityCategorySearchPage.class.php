<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: jdk1061
 * Date: 2/16/2020
 * Time: 14:19
 */


namespace extensions\trs\views\pages;


class CommodityCategorySearchPage extends BackOfficeDocument
{
    public function __construct()
    {
        parent::__construct('trs_commoditycategories-r', 'commoditycategories');

        $this->setVariable('tabTitle', 'Search Commodity Categories');
        $this->setVariable('content', self::templateFileContents('CommodityCategorySearchPage', self::TEMPLATE_PAGE, 'trs'));
    }
}