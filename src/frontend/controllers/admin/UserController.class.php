<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 11:54 AM
 */


namespace controllers\admin;


use controllers\Controller;
use views\pages\admin\UserCreatePage;
use views\pages\admin\UserEditPage;
use views\pages\admin\UserSearchPage;
use views\View;

class UserController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();

        switch($param)
        {
            case null:
                return new UserSearchPage();
            case 'new':
                return new UserCreatePage();
            default:
                return new UserEditPage($param);
        }
    }
}