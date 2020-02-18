<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: jdk1061
 * Date: 2/16/2020
 * Time: 14:22
 */


namespace extensions\trs\views\forms;


use views\forms\Form;

class NewCommodityCategoryForm extends Form
{
    /**
     * EditCommodityCategoryForm constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('CommodityCategoryForm', self::TEMPLATE_FORM, 'trs');
        $this->setVariable('menu', self::templateFileContents('ComCatNewFormMenu', self::TEMPLATE_ELEMENT, 'trs'));
        $this->setVariable('formScript', 'createCommodityCategory()');
    }
}