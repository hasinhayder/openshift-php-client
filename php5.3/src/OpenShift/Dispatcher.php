<?php

/* 
 * OpenShift PHP Rest Client Library
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */

namespace OpenShift;

class Dispatcher
{
    private $auth;
    private $endpoint = "https://openshift.redhat.com/broker/rest/api";

    function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    function post($requestUrl, $requestParams, $jsonDecode = true)
    {
        $data = $this->dispatch("POST", $requestUrl, $requestParams);
        if ($jsonDecode)
            return json_decode($data);
        else
            return $data;
    }

    function put($requestUrl, $requestParams, $jsonDecode = true)
    {
        $data = $this->dispatch("PUT", $requestUrl, $requestParams);
        if ($jsonDecode)
            return json_decode($data);
        else
            return $data;
    }

    function get($requestUrl, $jsonDecode = true)
    {
        $data = $this->dispatch("GET", $requestUrl);
        if ($jsonDecode)
            return json_decode($data);
        else
            return $data;
    }

    function delete($requestUrl, $jsonDecode = true)
    {
        $data = $this->dispatch("DELETE", $requestUrl);
        if ($jsonDecode)
            return json_decode($data);
        else
            return $data;
    }

    function dispatch($requestType, $requestUrl, $requestParams = array())
    {
        //echo $requestUrl;
        try {
            if (function_exists("curl_init")) {
                $auth = $this->auth;
                $username = $auth->getUser();
                $password = $auth->getPassword();
                $process = curl_init($requestUrl);
                //curl_setopt($process, CURLOPT_HEADER, 1);
                curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
                curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($process, CURLOPT_TIMEOUT, 300);
                if (($requestType == "POST" || $requestType == "PUT") && $requestParams)
                    curl_setopt($process, CURLOPT_POSTFIELDS, $requestParams);
                curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($process, CURLOPT_CUSTOMREQUEST, $requestType);
                curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
                $data = curl_exec($process);
                return $data;
            } else {
                throw new \Exception("PHP-CURL library is required but missing.");
            }
        } catch (\Exception $e) {
            print_r($e);
        }
    }


}