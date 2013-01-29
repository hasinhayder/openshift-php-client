<?php
class OpenShift{
  private $auth;
  private $dispatcher;
  public function __construct($username,$password){
    if(!$this->auth){
      $this->auth = new OpenShiftAuth($username,$password);
      $this->dispacher = new OpenShiftDispatcher($this->auth);
      ObjectBroker::register("openshift",$this);
      ObjectBroker::register("auth",$this->auth);
      ObjectBroker::register("dispatcher",$this->dispatcher);
    }
  }

  public function getAuth(){
    return $this->$auth;
  }

  public function getDispatcher(){
    return $this->$dispatcher;
  }
}

public  function getDomains(){
  if(!$this->domains){
    $this->domains = new OpenShiftDomains();
  }
  return $this->domains->getDomains();
}

public  function getDomain($domainName){
  if(!$this->domains){
    $this->domains = new OpenShiftDomains();
  }
  return $this->domains->getDomain($domainName);
}
}