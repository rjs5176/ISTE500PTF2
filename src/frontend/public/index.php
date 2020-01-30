<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 3/9/2019
 * Time: 2:41 PM
 */

spl_autoload_register(
    function($className)
    {
        /** @noinspection PhpIncludeInspection */
        require_once('../' . str_replace("\\", "/", $className) . ".class.php");
    }
);

\controllers\FrontController::renderPage();