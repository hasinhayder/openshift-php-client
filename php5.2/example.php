<?php


/* 
 * OpenShift PHP Rest Client Library Example
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @license MIT License 
 * @link https://github.com/hasinhayder/openshift-php-client
 */


include_once("lib/openshift.php");

$username = "YourUsername";
$password = "YourPassword";
$openshift = new OpenShift($username,$password);

echo "<pre>";

// Create a New Domain 
// $data = $openshift->getDomainManager()->createDomain("osphp");

// List Domains 
// $data = $openshift->getDomainManager()->getDomains();

// Rename the Domain
// $data = $openshift->getDomainManager()->getDomain("osphp")->updateName("moonlander") ;

// Create a Zend 5.6 App Container 
// $data = $openshift->getDomainManager()->getDomain("osphp")->createApplication("restclient","zend-5.6");

// Get all Applications 
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplications();

// Get Application Details
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->getDetails();

// Stop an Application
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->stop(); 

// Start an Application
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->start(); 

// Restart an Application
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->restart(); 

// Reload an Application
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->reload(); 

// Add an Alias
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->addAlias("mydomain.com");

// Remove an Alias
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->removeAlias("mydomain.com");

// Add a Cartridge
//$data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->addCartridge("mysql-5.1");

// Delete a Cartridge
// $data = $openshift->getDomainManager()->getDomain("osphp")->getApplication("restclient")->getCartridge("mysql-5.1")->delete();

// There are many other methods supported by applications, domains and the cartridges. For details, check their source code. 

print_r($data);