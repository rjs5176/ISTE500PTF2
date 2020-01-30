<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 7:35 PM
 */


namespace controllers;


use utilities\InfoCentralConnection;
use views\View;

class LogoutController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     */
    public function getPage(): ?View
    {
        if(isset($_COOKIE[\Config::OPTIONS['cookieName']]))
        {
            InfoCentralConnection::getResponse(InfoCentralConnection::PUT, "authenticate/logout");

            foreach(array_keys($_COOKIE) as $cookie)
            {
                setcookie($cookie, "", time() - 3600, \Config::OPTIONS['baseURI']);
            }
        }

        header("Location: " . \Config::OPTIONS['baseURI'] . "login?SUCCESS=" . "Successfully logged out");
        exit;
    }
}