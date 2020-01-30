<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 8:23 AM
 */


namespace views\pages;


use views\elements\Header;
use views\elements\Navigation;

abstract class PortalDocument extends AuthenticatedPage
{
    /**
     * PortalDocument constructor.
     * @param string|null $permission
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);

        $this->setVariable("content", self::templateFileContents("PortalDocument", self::TEMPLATE_PAGE));

        // Add header
        $header = new Header();
        $this->setVariable("header", $header->getTemplate());

        $navigation = new Navigation('', array());
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));

        $this->setVariable('operatorName', $this->user->getUsername());
    }
}