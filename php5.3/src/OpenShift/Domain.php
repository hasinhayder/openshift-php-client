<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class Domain
{
    private $domainName = "";
    private $dispatcher;
    private $apps;

    public function __construct($domainName)
    {
        $openShift = ObjectBroker::get("openshift");
        $this->dispatcher = $openShift->getDispatcher();
        $this->domainName = $domainName;
    }

    public function updateName($newName)
    {
        if ($newName == "")
            throw new \Exception("Valid domain name is required to update the name", 1);

        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}";
        $params = array("id" => $newName);
        $data = $this->dispatcher->put($url, $params);
        return $data;
    }

    public function delete($domainName)
    {
        $url = "https://openshift.redhat.com/broker/rest/domains/{$domainName}";
        throw new \Exception("Sorry dude, considering the risk - we have disabled deleting domains from this Library.");
        // $data = $this->dispatcher->delete($url);
        // return $data;
    }

    public function getApplications()
    {
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}/applications";
        $apps = $this->dispatcher->get($url);
        foreach ($apps->data as $app) {
            $_app = new App($app->name, $this->domainName, $app); //casting
            $this->apps[$app->name] = $_app;
        }
        return $apps;
    }

    public function getApplication($appName, $preFetchDetails = true)
    {
        if (!$this->apps[$appName]) {
            if ($preFetchDetails)
                $this->apps[$appName] = new App($appName, $this->domainName);
            else
                $this->apps[$appName] = new App($appName, $this->domainName, false, false);
        }
        return $this->apps[$appName];
    }

    public function getDomainDetails()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}";
        $data = $dispatcher->get($url);
        return $data;
    }

    /**
     * Valid Cartridge Names Are
     * [0] => nodejs-0.6
     * [1] => zend-5.6
     * [2] => ruby-1.9
     * [3] => jbossas-7
     * [4] => python-2.6
     * [5] => jenkins-1.4
     * [6] => ruby-1.8
     * [7] => jbosseap-6.0
     * [8] => diy-0.1
     * [9] => jbossews-1.0
     * [10] => php-5.3
     * [11] => perl-5.10
     */

    public function createApplication($name, $cartridge, $initialGitRepoUrl = "", $scale = false, $gearProfile = "small")
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();

        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}/applications";
        $params = array(
            "name" => $name,
            "cartridge" => $cartridge,
            "scale" => $scale,
            "gear_profile" => $gearProfile,
            "init_git_url" => $initialGitRepoUrl,
        );
        $data = $dispatcher->post($url, $params);
        return $data;
    }
}