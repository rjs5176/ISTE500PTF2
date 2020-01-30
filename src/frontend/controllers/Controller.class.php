<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 4:46 PM
 */


namespace controllers;


use models\HTTPRequest;
use views\View;

abstract class Controller
{
    protected $request;

    /**
     * Controller constructor.
     * @param HTTPRequest $request
     */
    public function __construct(HTTPRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return View
     */
    abstract public function getPage(): ?View;
}