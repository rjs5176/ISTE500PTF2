<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 5:01 PM
 */


namespace views\pages;

class LoginPage extends HTML5Document
{
    /**
     * LoginPage constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct();
        $this->setVariable("content", self::templateFileContents("LoginForm", self::TEMPLATE_FORM));
        $this->setVariable("tabTitle", "Login");
        $this->setVariable("appVersion", \Version::CURRENT_VERSION);
    }
}