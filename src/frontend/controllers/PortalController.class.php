<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 2:48 PM
 */


namespace controllers;


use views\pages\Portal;
use views\View;

class PortalController extends Controller
{
    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        return new Portal();
    }
}