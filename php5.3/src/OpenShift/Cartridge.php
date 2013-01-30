<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */


namespace OpenShift;

class Cartridge
{
    private $appName;
    private $domainId;
    private $cartridgeName;

    public function __construct($cartridgeName, $appName, $domainName)
    {
        $this->domainId = $domainName;
        $this->appName = $appName;
        $this->cartridgeName = $cartridgeName;
    }

    public function getCartridgeDetails()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}";
        $data = $dispatcher->get($url);
        return $data;
    }

    public function updateCartridge($keyValuePair)
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}";
        $data = $dispatcher->post($url, $keyValuePair);
        return $data;
    }

    public function start()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}/events";
        $params = array("event" => "start");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function stop()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}/events";
        $params = array("event" => "stop");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function restart()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}/events";
        $params = array("event" => "restart");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function reload()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}/events";
        $params = array("event" => "reload");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function delete()
    {
        // throw new Exception("Sorry dude, considering the risk - we have disabled deleting cartridges from this Library.");
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges/{$this->cartridgeName}";
        echo $url;
        $params = array("event" => "delete");
        $data = $dispatcher->delete($url);
        return $data;
    }
}