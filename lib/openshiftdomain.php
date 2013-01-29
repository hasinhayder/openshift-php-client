<?php

class OpenShiftDomain{
  private $domainName= "";
  private $dispatcher;

  public function __construct($domainName, OpenShift $openShift){
    $openShift = ObjectBroker::get("openshift");
    $this->dispatcher = $openShift->getDispatcher();
    $this->domainName= $domainName;
  }

  function updateName($newName){
    if($newName=="")
      throw new Exception("Valid domain name is required to update the name", 1);
      
    $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}";
    $params = array("id"=>$newName);
    $data = $this->dispatcher->put($url,$params);
    return $data;
  }

  function delete($domainName){
    $url = "https://openshift.redhat.com/broker/rest/domains/{$domainName}";
    throw new Exception("Sorry dude, considering the risk - we have disabled deleting domains from this Library.")
    // $data = $this->dispatcher->delete($url);
    // return $data;
  }

  function getApps(){
    $url = "https://openshift.redhat.com/broker/rest/domains/{$this->domainName}/applications";
    $apps = $this->dispatcher->get($url);
    return $apps;
  }
}