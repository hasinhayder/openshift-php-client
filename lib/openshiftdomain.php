<?php

class OpenShiftDomain{
  private $domainName= "";
  private $dispatcher;
  private $apps;

  public function __construct($domainName){
    $openShift = ObjectBroker::get("openshift");
    $this->dispatcher = $openShift->getDispatcher();
    $this->domainName= $domainName;
  }

  public function updateName($newName){
    if($newName=="")
      throw new Exception("Valid domain name is required to update the name", 1);
      
    $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}";
    $params = array("id"=>$newName);
    $data = $this->dispatcher->put($url,$params);
    return $data;
  }

  public function delete($domainName){
    $url = "https://openshift.redhat.com/broker/rest/domains/{$domainName}";
    throw new Exception("Sorry dude, considering the risk - we have disabled deleting domains from this Library.");
    // $data = $this->dispatcher->delete($url);
    // return $data;
  }

  public function getApps(){
    $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}/applications";
    $apps = $this->dispatcher->get($url);
    foreach ($apps->data as $app){
      $_app = new OpenShiftApp($app->name, $this->domainName, $app); //casting
      $this->apps[$app->name] = $_app; 
    }
    return $apps;
  }

  public function getApp($appName, $preFetchDetails = true){
    if(!$this->apps[$appName]){
      if($preFetchDetails)
      $this->apps[$appName] = new OpenShiftApp($appName, $this->domainName);
        else
      $this->apps[$appName] = new OpenShiftApp($appName, $this->domainName,false,false);
    }
    return $this->apps[$appName];
  }

  public function getDomainDetails(){
    $openshift = ObjectBroker::get("openshift");
    $dispatcher = $openshift->getDispatcher();
    $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}";
    $data = $dispatcher->get($url);
    return $data;
  }

  /** 
  * Valid Cartridge Names Are
  * [0] => mongodb-2.2  
  * [1] => switchyard-0.6
  * [2] => cron-1.4
  * [3] => haproxy-1.4
  * [4] => 10gen-mms-agent-0.1
  * [5] => phpmyadmin-3.4
  * [6] => metrics-0.1
  * [7] => rockmongo-1.1
  * [8] => jenkins-client-1.4
  */
  
  public function createApplication($name,$cartridge,$template,$scale,$gearProfile="small"){
    $openshift = ObjectBroker::get("openshift");
    $dispatcher = $openshift->getDispatcher();

    $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainId}/applications/applications";
    $params = array(
      "name"=>$name, 
      "cartridge"=>$cartridge,
      "template"=>$template,
      "scale"=>$scale,
      "gear_profile" = $gearProfile,
    );
    $data = $dispatcher->post($url,$params);
    return $data;
  }
}