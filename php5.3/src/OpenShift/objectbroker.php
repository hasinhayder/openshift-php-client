<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class ObjectBroker
{
    public static $stack = array();

    public static function register($key, $value)
    {
        self::$stack[$key] = $value;
    }

    //TODO: Change to static
    public static function get($key)
    {
        $object = self::$stack[$key];
        if (!$object)
            throw new \Exception("Object not found", 1);
        return $object;

    }
}