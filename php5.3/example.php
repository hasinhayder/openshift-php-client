<?php


/* 
 * OpenShift PHP Rest Client Library Example
 * @author Hasin Hayder | hasin@leevio.com | www.hasin.me
 * @author Abu Ashraf Masnun | masnun@gmail.com | www.masnun.me
 * @license MIT License
 * @link https://github.com/hasinhayder/openshift-php-client
 */

require_once 'autoloader.php';

//Autoloader
$autoloader = new SplClassLoader("OpenShift","src");
$autoloader->register();


use OpenShift\Client as OpenShift;

$username = "masnun@gmail.com"; // your account, most likely your email address
$password = "mySuperCryptikPa55W0rD!"; // your password
$openshift = new OpenShift($username,$password);

echo "<pre>";

// Create a New Domain 
// $data = $openshift->getDomainManager()->createDomain("osphp");

// List Domains 
// $data = $openshift->getDomainManager()->getDomains();

// Rename the Domain
// $data = $openshift->getDomainManager()->getDomain("osphp")->updateName("masnun") ;

// Create a Zend 5.6 App Container 
// $data = $openshift->getDomainManager()->getDomain("masnun")->createApplication("restclient","zend-5.6");

// Get all Applications 
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplications();

// Get Application Details
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->getDetails();

// Stop an Application
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->stop();

// Start an Application
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->start();

// Restart an Application
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->restart();

// Reload an Application
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->reload();

// Add an Alias
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->addAlias("mydomain.com");

// Remove an Alias
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->removeAlias("mydomain.com");

// Add a Cartridge
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->addCartridge("mysql-5.1");

// Delete a Cartridge
// $data = $openshift->getDomainManager()->getDomain("masnun")->getApplication("restclient")->getCartridge("mysql-5.1")->delete();

// There are many other methods supported by applications, domains and the cartridges. For details, check their source code. 

//print_r($data);