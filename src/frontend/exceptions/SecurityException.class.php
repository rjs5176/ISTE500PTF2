<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Content Management System 3
 *
 * User: lromero
 * Date: 3/25/2019
 * Time: 7:06 PM
 */


namespace exceptions;


class SecurityException extends MercuryException
{
    const USER_NOT_LOGGED_IN = 503;
    const TOKEN_NOT_VALID = 504;
    const USER_DOES_NOT_HAVE_PERMISSION = 506;
    const IP_NOT_IN_WHITELIST = 510;

    const MESSAGE = array(
        self::USER_NOT_LOGGED_IN => 'Please sign in',
        self::TOKEN_NOT_VALID => 'Session expired',
        self::USER_DOES_NOT_HAVE_PERMISSION => 'You do not have permission to view this page',
        self::IP_NOT_IN_WHITELIST => 'Request origin is not allowed to view this page'
    );
}