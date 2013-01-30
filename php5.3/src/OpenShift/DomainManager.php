<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class DomainManager
{
    private $openShift;
    private $endpoint = "https://openshift.redhat.com/broker/rest/domains";
    private $domains = array();
    private $dispatcher;

    public function __construct()
    {
        $openShift = ObjectBroker::get("openshift");
        $this->dispatcher = $openShift->getDispatcher();
    }


    public function getDomains()
    {
        $domainNames = array();
        if ($this->domains) {
            foreach ($this->domains as $key => $value) {
                $domainNames[] = $key;
            }
        } else {
            $url = $this->endpoint;
            $data = $this->dispatcher->get($url);
            foreach ($data->data as $key => $domain) {
                $domainName = $domain->id;
                $this->domains[strtolower($domainName)] = new Domain($domainName);
                $domainNames[] = $domainName;
            }
        }
        return $domainNames;
    }

    public function getDomain($domainName)
    {
        if (!$this->domains) {
            $this->getDomains();
        }

        if (empty($this->domains[strtolower($domainName)])) {
            $this->domains[strtolower($domainName)] = new Domain($domainName);
        }

        return $this->domains[strtolower($domainName)];
    }

    public function createDomain($domainName)
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains";
        $params = array("id" => $domainName);
        $data = $dispatcher->post($url, $params);
        return $data;
    }
}