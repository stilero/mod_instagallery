<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('_JEXEC', 1); 
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', '..'.DS.'..'.DS.'..');
}
define('JPATH_LIBRARIES', JPATH_BASE . DS . 'libraries');
define('INSTA_API_LIBRARIES', '..'.DS.'includes'.DS.'insta-api'.DS);
require_once JPATH_LIBRARIES . DS . 'import.php';
require_once JPATH_LIBRARIES . DS . 'joomla'.DS.'filter'.DS.'input.php';
JLoader::register('InstaError', INSTA_API_LIBRARIES.'InstaError.php');
JLoader::register('Communicator', INSTA_API_LIBRARIES.'Communicator.php');
JLoader::register('InstaOauth', INSTA_API_LIBRARIES.'InstaOauth.php');
JLoader::register('InstaClient', INSTA_API_LIBRARIES.'InstaClient.php');
JLoader::register('InstaOauthAccessToken', INSTA_API_LIBRARIES.'InstaOauthAccessToken.php');
$jinput = new JFilterInput();
$clientId = $jinput->clean($_POST['client_id'], '', 'BASE64');
$clientSecret = $jinput->clean($_POST['client_secret'], '', 'BASE64');
$authCode = $jinput->clean($_POST['code'], '', 'BASE64');
$redirectURI = $jinput->clean($_POST['redirect_uri'], '', 'RAW');
$InstaClient = new InstaClient($clientId, $clientSecret);
$InstaAccessToken = new InstaOauthAccessToken($InstaClient, $redirectURI, $authCode);
$token = $InstaAccessToken->requestAccessToken();
print $token;
?>
