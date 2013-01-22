<?php
/**
 * HTTP Request dispatcher using Curl
 */
class OpenShiftDispatcher{
  private $auth;
  private $endpoint = "https://openshift.redhat.com/broker/rest/api";

  function __construct(OpenShiftAuth $auth){
    $this->auth = $auth;
  }

  function post($requestUrl, $requestParams,jsonDecode=true){
      $data =  $this->dispatch("POST",$requestUrl,$requestParams);
      if($jsonDecode) 
        return json_decode($data);
      else
        return $data;
  }

  function get($requestUrljsonDecode=true){
      $data =  $this->dispatch("GET",$requestUrl);
      if($jsonDecode) 
        return json_decode($data);
      else
        return $data;
  }

  function delete($requestUrljsonDecode=true){
      $data =  $this->dispatch("DELETE",$requestUrl);
      if($jsonDecode) 
        return json_decode($data);
      else
        return $data;
  }

  function dispatch($requestType, $requestUrl, $requestParams=array()){
    if(function_exists("curl_init")){
      $auth = $this->auth;
      $username = $auth->getUser();
      $password = $auth->getPassword();
      $process = curl_init($this->endpoint);
      curl_setopt($process, CURLOPT_HEADER, 1);
      curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
      curl_setopt($process, CURLOPT_TIMEOUT, 30);
      curl_setopt($process, CURLOPT_CUSTOMREQUEST, $requestType);
      if($requestType=="POST" && $requestParams)
      curl_setopt($process, CURLOPT_POSTFIELDS, $requestParams);
      curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($process);
      curl_close($process);
      return $data;
    }else {
      throw new Exception("PHP-CURL library is required which is missing.")
    }
  }


}