<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 3/22/2019
 * Time: 6:07 PM
 */


namespace exceptions;

/**
 * Class ViewException
 * @package exceptions
 */
class ViewException extends MercuryException
{
    const VIEW_NOT_FOUND = 601;
    const TEMPLATE_NOT_FOUND = 602;
    const ELEMENT_NOT_FOUND = 603;
    const PAGE_NOT_FOUND = 604;

    const MESSAGES = array(
        self::VIEW_NOT_FOUND => "View Not Found",
        self::TEMPLATE_NOT_FOUND => "Template Not Found",
        self::ELEMENT_NOT_FOUND => "Element Not Found",
        self::PAGE_NOT_FOUND => "Page Type Not Found"
    );
}