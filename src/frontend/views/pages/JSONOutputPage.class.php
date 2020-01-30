<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 9:38 PM
 */


namespace views\pages;

use views\View;

/**
 * Class JSONOutputPage
 *
 * A page for outputting json
 *
 * @package views\pages
 */
class JSONOutputPage extends View
{
    public function __construct(string $json)
    {
        $this->setTemplate($json);
    }
}