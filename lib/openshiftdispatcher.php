<?php
/**
 * HTTP Request dispatcher using Curl
 */
class OpenShiftDispatcher{
  private $auth;

  function __construct(OpenShiftAuth $auth){
    $this->auth = $auth;
  }
}