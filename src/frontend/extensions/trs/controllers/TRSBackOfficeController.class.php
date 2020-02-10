<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 2:30 PM
 */


namespace extensions\trs\controllers;


use controllers\Controller;
use extensions\trs\views\pages\BackOfficeHomePage;
use extensions\trs\views\pages\OrganizationEditPage;
use extensions\trs\views\pages\OrganizationNewPage;
use extensions\trs\views\pages\OrganizationSearchPage;
use views\View;

class TRSBackOfficeController extends Controller
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
        $p1 = $this->request->next(); // First part of URI
        $p2 = $this->request->next(); // Second part of URI
        $p3 = $this->request->next(); // Third part of URI

        if($p1 === NULL)
            return new BackOfficeHomePage();
        else if($p1 === 'organizations')
        {
            if($p2 === NULL)
            {
                return new OrganizationSearchPage();
            }
            else if($p2 === 'new' AND $p3 === NULL)
            {
                return new OrganizationNewPage();
            }
            else if($p2 !== NULL AND $p3 === NULL)
            {
                return new OrganizationEditPage($p2);
            }
        }

        return NULL;
    }
}