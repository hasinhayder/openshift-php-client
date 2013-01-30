<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class Client
{
    private $auth;
    private $dispatcher;
    private $domainManager;

    public function __construct($username, $password)
    {
        if (!$this->auth) {
            $this->auth = new Auth($username, $password);
            $this->dispatcher = new Dispatcher($this->auth);
            ObjectBroker::register("openshift", $this);
            ObjectBroker::register("auth", $this->auth);
            ObjectBroker::register("dispatcher", $this->dispatcher);
            return $this; //for method chaining
        }
    }

    public function getAuth()
    {
        return $this->auth;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function getDomainManager()
    {
        if (!$this->domainManager) {
            $this->domainManager = new DomainManager();
        }
        return $this->domainManager;
    }
}