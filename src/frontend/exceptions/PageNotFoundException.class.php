<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 3/23/2019
 * Time: 9:20 AM
 */


namespace exceptions;


class PageNotFoundException extends MercuryException
{
    const PAGE_NOT_FOUND = 1400;

    const MESSAGES = array(
        self::PAGE_NOT_FOUND => "Page not found"
    );
}