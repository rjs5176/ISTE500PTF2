<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: jdk1061
 * Date: 2/16/2020
 * Time: 14:23
 */


namespace extensions\trs\views\forms;


use views\forms\Form;

class EditCommodityCategoryForm extends Form
{
    /**
     * EditCommodityCategoryForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('CommodityCategoryForm', self::TEMPLATE_FORM, 'trs');
        $this->setVariable('menu', self::templateFileContents('ComCatEditFormMenu', self::TEMPLATE_ELEMENT, 'trs'));
        $this->setVariable('formScript', 'editCommodityCategory(\'{{@id}}\')');

        // History link
        $this->setVariable('historyLink', "<a class=\"history-link\" href=\"{{@baseURI}}history/trscommoditycategory/{{@id}}\"><i class=\"icon\" title=\"View History\">history</i></a>");
    }
}