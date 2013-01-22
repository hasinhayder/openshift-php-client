<?php

class OpenShiftDomain{
  private $endpoint = "https://openshift.redhat.com/broker/rest/domains";
  private $auth;
  private $dispatcher;

  public __construct(OpenShiftAuth $auth, OpenShiftDispatcher $dispatcher){
    $this->auth = $auth;
    $this->dispatcher = $dispatcher;
  }

  public getDomains(){
    $url = $this->endpoint;
    $data = $this->dispatcher->get($url);
  }
}