<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 4:34 PM
 */


namespace controllers\admin;


use controllers\Controller;
use views\pages\admin\AdminHomePage;
use views\pages\admin\BadLogSearchPage;
use views\pages\admin\PermissionAuditSearchPage;
use views\pages\admin\SendNotificationPage;
use views\pages\admin\UserLogSearchPage;
use views\View;

class AdminController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();

        switch($param)
        {
            case 'bulletins':
                $bulletins = new BulletinController($this->request);
                return $bulletins->getPage();
            case 'roles':
                $roles = new RoleController($this->request);
                return $roles->getPage();
            case 'icadmin':
                $api = new APIKeyController($this->request);
                return $api->getPage();
            case 'users':
                $users = new UserController($this->request);
                return $users->getPage();
            case 'userlogs':
                return new UserLogSearchPage();
            case 'badlogs':
                return new BadLogSearchPage();
            case 'permissions':
                return new PermissionAuditSearchPage();
            case 'notifications':
                if($this->request->next() === 'send')
                    return new SendNotificationPage();
                break;
            case NULL:
                return new AdminHomePage();
        }

        return NULL;
    }
}