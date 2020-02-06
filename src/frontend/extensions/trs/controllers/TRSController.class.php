<?php
/**
 * User: rjs5176
 * Date: 02/01/2020
 * Time: 3:10 PM
 */


namespace extensions\trs\controllers;


use controllers\Controller;
//use extensions\tickets\views\pages\TicketHome;
use views\View;
use extentions\trs\views\pages\TRSHomepage;

class TRSController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\ParameterException
     */
    public function getPage(): ?View
    {
        return new TRSHomepage();
    }
}