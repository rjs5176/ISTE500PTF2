<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 11:00 AM
 */


namespace controllers;


use views\pages\AccountPage;
use views\pages\ChangePasswordPage;
use views\View;

class AccountController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        switch($this->request->next())
        {
            case "changepassword":
                return $this->changePassword();
            default:
                return new AccountPage();
        }
    }

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    private function changePassword(): View
    {
        $page = new ChangePasswordPage();

        if(!empty($_POST))
        {
            $errors = $page->validateForm();

            if(!empty($errors))
            {
                $page->setErrors($errors);
            }
            else
            {
                header("Location: " . \Config::OPTIONS['baseURI'] . "account?SUCCESS=Password has been changed");
                exit;
            }
        }

        return $page;
    }
}