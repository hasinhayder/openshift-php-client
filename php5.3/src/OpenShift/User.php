<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class User
{
    public function __construct()
    {

    }

    public function getUserDetails()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/user";
        $data = $dispatcher->get($url);
        return $data;
    }

    public function getSshkeys()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/user/keys";
        $data = $dispatcher->get($url);
        return $data;
    }

    public function addSshKey($name, $type, $content)
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/user/keys";
        $params = array("name" => $name, "type" => $type, "content" => urlencode($content));
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function deleteSshKey($keyName)
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/user/keys/{$keyName}";
        $data = $dispatcher->delete($url);
        return $data;
    }
}