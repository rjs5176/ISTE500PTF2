<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: jdk1061
 * Date: 2/17/2020
 * Time: 16:10
 */


namespace extensions\trs\views\pages;


use extensions\trs\views\forms\NewCommodityCategoryForm;

class CommodityCategoryNewPage extends BackOfficeDocument
{
    public function __construct()
    {
        parent::__construct('trs_commoditycategories-w', 'commoditycategories');

        $this->setVariable('tabTitle', 'Create Commodity Category');

        $form = new NewCommodityCategoryForm();

        $this->setVariable('content', $form->getTemplate());
    }
}