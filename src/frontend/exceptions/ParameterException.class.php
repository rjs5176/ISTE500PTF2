<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 11:06 PM
 */


namespace exceptions;


class ParameterException extends MercuryException
{
    const URI_PARAMETER_MISSING = 1601;
    const PARAMETER_INVALID = 1602;

    const MESSAGES = array(
        self::URI_PARAMETER_MISSING => 'A required URI parameter was not supplied',
        self::PARAMETER_INVALID => 'A required parameter is not valid'
    );
}