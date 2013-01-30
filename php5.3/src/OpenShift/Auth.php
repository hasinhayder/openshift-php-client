<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class Auth
{
    private $user;
    private $password;

    public function __construct($user, $password)
    {
        if (!$user || !$password)
            throw new \Exception("username and password are required");
        $this->user = $user;
        $this->password = $password;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
