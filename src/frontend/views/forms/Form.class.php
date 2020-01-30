<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 11:38 AM
 */


namespace views\forms;


use views\View;

abstract class Form extends View
{
    protected $fields;

    /**
     * Converts post submission into a valid array, with non-submitted entries set to null
     * and non-valid fields omitted
     *
     * @return array
     */
    protected function formAsArray(): array
    {
        $fields = array();

        foreach($this->fields as $field)
        {
            if(isset($_POST[$field]))
                $fields[$field] = $_POST[$field];
            else
                $fields[$field] = null;
        }

        return $fields;
    }
}