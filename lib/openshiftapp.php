<?php

class OpenShiftApp{
  private $appName;
  private $aliases;
  private $appUrl;
  private $buildJobUrl;
  private $buildingWith;
  private $creationTime;
  private $domainId;
  private $framework;
  private $gearCount;
  private $gearProfile;
  private $gitUrl;
  private $sshUrl;
  private $uuid;
  private $scalable;

  public function __construct($appName, $domainId){
    $this->appName = $appName;
    $this->domainId = $domainId;
  }
}