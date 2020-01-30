<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 4:52 PM
 */


namespace views\pages;


use exceptions\SecurityException;
use utilities\IPAddressChecker;
use views\elements\Header;

abstract class PublicDocument extends HTML5Document
{
    /**
     * PublicDocument constructor.
     * @param bool $useWhitelist
     * @throws \exceptions\ViewException
     * @throws SecurityException
     */
    public function __construct(bool $useWhitelist = FALSE)
    {
        parent::__construct();

        // If whitelist is in use, verify the remote IP is on it
        if($useWhitelist AND !IPAddressChecker::isRemoteAddressOnWhitelist())
            throw new SecurityException(SecurityException::MESSAGE[SecurityException::IP_NOT_IN_WHITELIST], SecurityException::IP_NOT_IN_WHITELIST);

        $header = new Header();
        $this->setVariable('header', $header->getTemplate());
        $this->setVariable('footer', self::templateFileContents('Footer', self::TEMPLATE_ELEMENT));

        $this->setVariable('operatorName', 'IP: ' . $_SERVER['REMOTE_ADDR']);
    }
}