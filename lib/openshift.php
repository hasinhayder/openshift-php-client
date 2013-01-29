<?php
include_once("openshiftauth.php");
include_once("openshiftdispatcher.php");
include_once("openshiftdomainmanager.php");
include_once("openshiftdomain.php");
include_once("openshiftapp.php");
include_once("openshiftcartridge.php");
include_once("objectbroker.php");

class OpenShift{
  private $auth;
  private $dispatcher;
  private $domainManager;
  public function __construct($username,$password){
    if(!$this->auth){
      $this->auth = new OpenShiftAuth($username,$password);
      $this->dispatcher = new OpenShiftDispatcher($this->auth);
      ObjectBroker::register("openshift",$this);
      ObjectBroker::register("auth",$this->auth);
      ObjectBroker::register("dispatcher",$this->dispatcher);
      return $this; //for method chaining
    }
  }

  public function getAuth(){
    return $this->auth;
  }

  public function getDispatcher(){
    return $this->dispatcher;
  }

  public  function getDomainManager(){
    if(!$this->domainManager){
      $this->domainManager = new OpenShiftDomainManagaer();
    }
    return $this->domainManager;
  }
}