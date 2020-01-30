<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 10/30/2019
 * Time: 3:52 PM
 */


namespace views\pages;


use views\View;

class ScriptPage extends View
{
    public function __construct($path)
    {
        self::setTemplate(file_get_contents($path));
    }
}