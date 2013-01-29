<?php

class OpenShiftApp{
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
  private $hasDetails = false;

  public function getAppName() { return $this->appName; } 
  public function getAliases() { return $this->aliases; } 
  public function getAppUrl() { return $this->appUrl; } 
  public function getBuildJobUrl() { return $this->buildJobUrl; } 
  public function getBuildingWith() { return $this->buildingWith; } 
  public function getBuildingApp() { return $this->buildingApp; } 
  public function getCreationTime() { return $this->creationTime; } 
  public function getDomainId() { return $this->domainId; } 
  public function getFramework() { return $this->framework; } 
  public function getGearCount() { return $this->gearCount; } 
  public function getGearProfile() { return $this->gearProfile; } 
  public function getGitUrl() { return $this->gitUrl; } 
  public function getSshUrl() { return $this->sshUrl; } 
  public function getUuid() { return $this->uuid; } 
  public function getScalable() { return $this->scalable; } 
  public function getCartridges($name="") { 
    if($name)
    return $this->cartridges['name']; 
    return $this->cartridges; 
  } 


  public function setAppName($data) { $this->appName = $data; } 
  public function setAliases($data) { $this->aliases = $data; } 
  public function setAppUrl($data) { $this->appUrl = $data; } 
  public function setBuildJobUrl($data) { $this->buildJobUrl = $data; } 
  public function setBuildingWith($data) { $this->buildingWith = $data; } 
  public function setBuildingApp($data) { $this->buildingApp = $data; } 
  public function setCreationTime($data) { $this->creationTime = $data; } 
  public function setDomainId($data) { $this->domainId = $data; } 
  public function setFramework($data) { $this->framework = $data; } 
  public function setGearCount($data) { $this->gearCount = $data; } 
  public function setGearProfile($data) { $this->gearProfile = $data; } 
  public function setGitUrl($data) { $this->gitUrl = $data; } 
  public function setSshUrl($data) { $this->sshUrl = $data; } 
  public function setUuid($data) { $this->uuid = $data; } 
  public function setScalable($data) { $this->scalable = $data; } 
  public function addCartridge($name,$data) { 
    $this->cartridges[$name] = $data; 
  } 

  public function __construct($appName, $domainId, $propBundle=0) {
    $this->setAppName($appName);
    $this->setDomainId($domainId);

    if($propBundle){
      //casting required
      $this->setAliases($propBundle->aliases);
      $this->setAppUrl($propBundle->app_url);
      $this->setBuildingWith($propBundle->building_with);
      $this->setBuildJobUrl($propBundle->build_job_url);
      $this->setBuildingApp($propBundle->building_app);
      $this->setCreationTime($propBundle->creation_time);
      foreach($app->embedded as $name=>$cartridge){
        $this->addCartridge($name,$cartridge);
      } 
      $this->setFramework($propBundle->framework);
      $this->setGearCount($propBundle->gear_count);
      $this->setGearProfile($propBundle->gear_profile);
      $this->setGitUrl($propBundle->git_url);
      $this->setSshUrl($propBundle->ssh_url);
      $this->setScalable($propBundle->scalable);
      $this->setUuid($propBundle->uuid);
    }
  }

  public function hasDetails() {
    return $this->hasDetails;
  }

  public function makeZombie() {
    $this->hasDetails = 1;
  }


}