<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 4:59 PM
 */


namespace controllers;


use models\HTTPResponse;
use utilities\InfoCentralConnection;
use views\pages\LoginPage;
use views\View;

class LoginController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function getPage(): ?View
    {
        $page = new LoginPage();

        // If cookie is set, verify it is ok and redirect to home
        if(isset($_COOKIE[\Config::OPTIONS['cookieName']]))
        {
            $response = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser");

            if($response->getResponseCode() == HTTPResponse::OK)
            {
                header("Location: " . \Config::OPTIONS['baseURI']);
                exit;
            }
            else if($response->getResponseCode() == HTTPResponse::UNAUTHORIZED)
            {
                $page->setNotices($response->getBody()['errors']);

                // Unset cookie
                setcookie(\Config::OPTIONS['cookieName'], "", time() - 3600, \Config::OPTIONS['baseURI']);
            }
        }

        if(isset($_POST['username']) AND isset($_POST['password']))
        {
            $response = InfoCentralConnection::getResponse(InfoCentralConnection::POST, "authenticate/login", array('username' => $_POST['username'],
                                                                                                                                      'password' => $_POST['password'],
                                                                                                                                      'remoteAddr' => $_SERVER['REMOTE_ADDR']));

            // If response code is not 204, token was not created
            if($response->getResponseCode() !== HTTPResponse::CREATED AND isset($response->getBody()['errors']))
                $page->setErrors($response->getBody()['errors']);
            else
            {
                // Set token
                setcookie(\Config::OPTIONS['cookieName'], $response->getBody()['token'], 0, \Config::OPTIONS['baseURI']);

                $next = \Config::OPTIONS['baseURI'];

                if(isset($_GET['NEXT']))
                    $next = $_GET['NEXT'];

                // Redirect
                header("Location: " . $next);
                exit;
            }
        }

        return $page;
    }
}