<?php
class OpenShiftAuth{
  private $user;
  private $password;
  public __construct($user, $password){
    if(!$user || !$password)
      throw new Exception("username and password are required");
    $this->user = $user;
    $this->password = $password;
  }

  public getUser(){
    return $this->user;
  }

  public getPassword(){
    return $this->password;
  }
}
