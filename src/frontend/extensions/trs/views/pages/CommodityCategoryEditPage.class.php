<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: jdk1061
 * Date: 2/16/2020
 * Time: 14:20
 */


namespace extensions\trs\views\pages;


use extensions\trs\views\forms\EditCommodityCategoryForm;

class CommodityCategoryEditPage extends BackOfficeModelPage
{
    public function __construct(?string $orgID)
    {
        parent::__construct('trs/commodity/categories' . $orgID, 'trs_commoditycategories-r', 'commoditycategories');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Editing Commodity Category ' . htmlentities($details['name']));

        $form = new EditCommodityCategoryForm($details);

        $this->setVariable('content', $form->getTemplate());
    }
}