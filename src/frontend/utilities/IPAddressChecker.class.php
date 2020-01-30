<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 5:57 PM
 */


namespace utilities;


class IPAddressChecker
{
    /**
     * Check if the IP address is on the whitelist
     * @return bool
     */
    public static function isRemoteAddressOnWhitelist(): bool
    {
        // Whitelist not set or empty, ignore it
        if(!isset(\Config::OPTIONS['ipWhitelist']) OR empty(\Config::OPTIONS['ipWhitelist']))
            return TRUE;

        $remoteAddr = $_SERVER['REMOTE_ADDR'];

        foreach(\Config::OPTIONS['ipWhitelist'] as $range)
        {
            list ($subnet, $bits) = explode('/', $range);

            if($bits === NULL)
                $bits = 32;

            $ip = ip2long($remoteAddr);
            $subnet = ip2long($subnet);

            $mask = -1 << (32 - $bits);
            $subnet &= $mask;

            if(($ip & $mask) == $subnet)
                return TRUE;
        }

        return FALSE;
    }
}