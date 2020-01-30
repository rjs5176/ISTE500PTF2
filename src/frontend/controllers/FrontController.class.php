<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 4:44 PM
 */


namespace controllers;

use exceptions\PageNotFoundException;
use exceptions\SecurityException;
use factories\ControllerFactory;
use models\HTTPRequest;
use utilities\URIParser;
use views\pages\ErrorPage;

class FrontController
{
    /**
     * Echo out the page to the user
     */
    public static function renderPage(): void
    {
        try
        {
            $page = ControllerFactory::getController(new HTTPRequest(URIParser::getURIParts()))->getPage();

            if($page === NULL)
                throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);

            echo $page->render();
        }
        catch (\Exception $e)
        {
            if($e instanceof SecurityException)
            {
                if($e->getCode() === SecurityException::USER_NOT_LOGGED_IN OR $e->getCode() === SecurityException::TOKEN_NOT_VALID)
                    self::goToLogin($e->getMessage());
            }

            try
            {
                $page = new ErrorPage($e);
                echo $page->render();
            }
            catch(SecurityException $e)
            {
                self::goToLogin($e->getMessage());
            }
            catch (\Exception $e)
            {
                die("INFOSCAPE encountered an unrecoverable error: " . $e->getMessage());
            }

        }
    }

    /**
     * @param string $message
     */
    public static function goToLogin(string $message): void
    {
        header("Location: " . \Config::OPTIONS['baseURI'] . "login?NOTICE=" . $message . "&NEXT=" . $_SERVER['REQUEST_URI']);
        exit;
    }
}