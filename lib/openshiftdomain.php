<?php

class OpenShiftDomain{
  private $endpoint = "https://openshift.redhat.com/broker/rest/domains";
  private $auth;
  private $dispatcher;

  public function __construct(OpenShiftDispatcher $dispatcher){
    // $this->auth = $auth;
    $this->dispatcher = $dispatcher;
  }

  public function getDomains(){
    $url = $this->endpoint;
    $data = $this->dispatcher->get($url);
  }
}