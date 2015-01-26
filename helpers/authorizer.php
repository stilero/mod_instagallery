<?php
/**
 * Small class to authorize the oauth
 * 
 * The images will be contained as follows:
 * $response[][]->image->images->thumbnail->url
 *
 * @version  1.0
 * @author Daniel Eliasson (joomla@stilero.com)
 * @copyright  (C) 2013-apr-16 Stilero Webdesign (www.stilero.com)
 * @category Module Helper
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('_JEXEC', 1); 
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', '..'.DS.'..'.DS.'..');
}

// no direct access
defined('_JEXEC') or die('Restricted access'); 

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