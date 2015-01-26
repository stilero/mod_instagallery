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
define( 'DS', DIRECTORY_SEPARATOR );
if (!defined('JPATH_BASE')){
    define('JPATH_BASE', '..'.DS.'..'.DS.'..');
}
define('_JEXEC', 1); 

// no direct access
defined('_JEXEC') or die('Restricted access'); 
define('JPATH_LIBRARIES', JPATH_BASE . DS . 'libraries');
require_once JPATH_LIBRARIES . DS . 'import.php';
require_once '..'.DS.'instaClass.php';
$clientId = JRequest::getVar('client_id');
$clientSecret = JRequest::getVar('client_secret');
$authCode = JRequest::getVar('code');
$redirectURI = JRequest::getVar('redirect_uri');
$config = array(
    'redirectURI'   =>  $redirectURI
);
$instagram = new instaClass($clientId, $clientSecret, $authCode,'', $config);
$token  = $instagram->requestAccessToken($authCode);
print $token;
?>
