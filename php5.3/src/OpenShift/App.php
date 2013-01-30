<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class App
{
    private $appName;
    private $aliases;
    private $appUrl;
    private $buildJobUrl;
    private $buildingWith;
    private $buildingApp;
    private $creationTime;
    private $domainId;
    private $framework;
    private $gearCount;
    private $gearProfile;
    private $gitUrl;
    private $sshUrl;
    private $uuid;
    private $scalable;
    private $cartridges;
    private $_cartridges;
    private $hasDetails = false;

    /* popuated later */
    private $gears;
    private $descriptor;
    private $gearGroups;


    public function getAppName()
    {
        return $this->appName;
    }

    public function getAliases()
    {
        return $this->aliases;
    }

    public function getAppUrl()
    {
        return $this->appUrl;
    }

    public function getBuildJobUrl()
    {
        return $this->buildJobUrl;
    }

    public function getBuildingWith()
    {
        return $this->buildingWith;
    }

    public function getBuildingApp()
    {
        return $this->buildingApp;
    }

    public function getCreationTime()
    {
        return $this->creationTime;
    }

    public function getDomainId()
    {
        return $this->domainId;
    }

    public function getFramework()
    {
        return $this->framework;
    }

    public function getGearCount()
    {
        return $this->gearCount;
    }

    public function getGearProfile()
    {
        return $this->gearProfile;
    }

    public function getGitUrl()
    {
        return $this->gitUrl;
    }

    public function getSshUrl()
    {
        return $this->sshUrl;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getScalable()
    {
        return $this->scalable;
    }

    public function getCartridges($name = "")
    {
        if ($name)
            return $this->cartridges['name'];
        return $this->cartridges;
    }


    public function setAppName($data)
    {
        $this->appName = $data;
    }

    public function setAliases($data)
    {
        $this->aliases = $data;
    }

    public function setAppUrl($data)
    {
        $this->appUrl = $data;
    }

    public function setBuildJobUrl($data)
    {
        $this->buildJobUrl = $data;
    }

    public function setBuildingWith($data)
    {
        $this->buildingWith = $data;
    }

    public function setBuildingApp($data)
    {
        $this->buildingApp = $data;
    }

    public function setCreationTime($data)
    {
        $this->creationTime = $data;
    }

    public function setDomainId($data)
    {
        $this->domainId = $data;
    }

    public function setFramework($data)
    {
        $this->framework = $data;
    }

    public function setGearCount($data)
    {
        $this->gearCount = $data;
    }

    public function setGearProfile($data)
    {
        $this->gearProfile = $data;
    }

    public function setGitUrl($data)
    {
        $this->gitUrl = $data;
    }

    public function setSshUrl($data)
    {
        $this->sshUrl = $data;
    }

    public function setUuid($data)
    {
        $this->uuid = $data;
    }

    public function setScalable($data)
    {
        $this->scalable = $data;
    }

    public function _addCartridge($name, $data)
    {
        $this->cartridges[$name] = $data;
    }

    public function __construct($appName, $domainId, $propBundle = 0, $preFetchDetails = true)
    {
        $this->setAppName($appName);
        $this->setDomainId($domainId);

        if ($propBundle) {
            //casting required
            $this->setAliases($propBundle->aliases);
            $this->setAppUrl($propBundle->app_url);
            $this->setBuildingWith($propBundle->building_with);
            $this->setBuildJobUrl($propBundle->build_job_url);
            $this->setBuildingApp($propBundle->building_app);
            $this->setCreationTime($propBundle->creation_time);
            foreach ($propBundle->embedded as $name => $cartridge) {
                $this->_addCartridge($name, $cartridge);
            }
            $this->setFramework($propBundle->framework);
            $this->setGearCount($propBundle->gear_count);
            $this->setGearProfile($propBundle->gear_profile);
            $this->setGitUrl($propBundle->git_url);
            $this->setSshUrl($propBundle->ssh_url);
            $this->setScalable($propBundle->scalable);
            $this->setUuid($propBundle->uuid);

            $this->makeZombie();
        } else {
            if ($preFetchDetails)
                $this->fetchDetails();
        }

    }

    public function hasDetails()
    {
        return $this->hasDetails;
    }

    public function makeZombie()
    {
        $this->hasDetails = 1;
    }

    private function fetchDetails()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}";
        $data = $dispatcher->get($url);
        $propBundle = $data->data;

        $this->setAliases($propBundle->aliases);
        $this->setAppUrl($propBundle->app_url);
        $this->setBuildingWith($propBundle->building_with);
        $this->setBuildJobUrl($propBundle->build_job_url);
        $this->setBuildingApp($propBundle->building_app);
        $this->setCreationTime($propBundle->creation_time);
        foreach ($propBundle->embedded as $name => $cartridge) {
            $this->_addCartridge($name, $cartridge);
        }
        $this->setFramework($propBundle->framework);
        $this->setGearCount($propBundle->gear_count);
        $this->setGearProfile($propBundle->gear_profile);
        $this->setGitUrl($propBundle->git_url);
        $this->setSshUrl($propBundle->ssh_url);
        $this->setScalable($propBundle->scalable);
        $this->setUuid($propBundle->uuid);

        $this->makeZombie();
    }

    public function getDetails()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}";
        $data = $dispatcher->get($url);
        return $data;
    }


    public function getGears()
    {
        if ($this->gears)
            return $this->gears;
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/gears";
        $data = $dispatcher->get($url);
        $this->gears = $data->data;
        return $this->gears;
    }

    public function getGearGroups()
    {
        if ($this->gearGroups)
            return $this->gearGroups;
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/gear_groups";
        $data = $dispatcher->get($url);
        $this->gearGroups = $data->data;
        return $this->gearGroups;
    }

    public function getDescriptor()
    {
        if ($this->descriptor)
            return $this->descriptor;
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/descriptor";
        $data = $dispatcher->get($url);
        $this->descriptor = $data->data;
        return $this->descriptor;
    }

    public function start()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "start");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function stop()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "stop");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function restart()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "restart");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function reload()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "reload");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function delete()
    {
        throw new \Exception("Sorry dude, considering the risk - we have disabled deleting applications from this Library.");
        // $openshift = ObjectBroker::get("openshift");
        // $dispatcher = $openshift->getDispatcher();
        // $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        // $data = $dispatcher->delete($url);
        // return $data;
    }

    public function forceStop()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "force-stop");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function exposePort()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "expose-port");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function concealPort()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "conceal-port");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function showPort()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "show-port");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function addAlias($alias)
    {
        if (!$alias) throw new \Exception("Alias is missing", 1);
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "add-alias", "alias" => $alias);
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function removeAlias($alias)
    {
        if (!$alias) throw new \Exception("Alias is missing", 1);
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "remove-alias", "alias" => $alias);
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function scaleUp()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "scale-up");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function scaleDown()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "scale-down");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function tidy()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "tidy");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function threadDump()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/events";
        $params = array("event" => "thread-dump");
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    /**
     * Valid Names Are
     * [0] => mongodb-2.2
     * [1] => switchyard-0.6
     * [2] => cron-1.4
     * [3] => haproxy-1.4
     * [4] => 10gen-mms-agent-0.1
     * [5] => phpmyadmin-3.4
     * [6] => metrics-0.1
     * [7] => rockmongo-1.1
     * [8] => jenkins-client-1.4
     * [9] => mysql-5.1
     */
    public function addCartridge($name)
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges";
        $params = array("cartridge" => $name);
        $data = $dispatcher->post($url, $params);
        return $data;
    }

    public function listCartridges()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/cartridges";
        $data = $dispatcher->get($url);
        return $data;
    }

    public function resolveDns()
    {
        $openshift = ObjectBroker::get("openshift");
        $dispatcher = $openshift->getDispatcher();
        $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/{$this->appName}/dns_resolvable";
        $data = $dispatcher->get($url);
        return $data;
    }

    public function getCartridge($name)
    {
        if (!$this->_cartridges[$name])
            $this->_cartridges[$name] = new Cartridge($name, $this->appName, $this->domainId);

        return $this->_cartridges[$name];
    }

}